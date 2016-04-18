/*
 <a href="posts/2" data-method="delete"> <---- We want to send an HTTP DELETE request
 - Or, request confirmation in the process -
 <a href="posts/2" data-method="delete" data-confirm="Are you sure?">
 */

(function() {

    var laravelDestroy = {
        initialize: function() {
            this.methodLinks = $('a[data-method]');
            if(this.methodLinks.length > 0){
                this.registerEvents();
            }
        },

        registerEvents: function() {
            this.methodLinks.on('click', this.handleMethod);
        },

        handleMethod: function(e) {
            var link = $(this);
            var httpMethod = link.data('method').toUpperCase();
            var form;

            // If the data-method attribute is not PUT or DELETE,
            // then we don't know what to do. Just ignore.
            if ( $.inArray(httpMethod, ['PUT', 'DELETE', 'POST']) === - 1 ) {
                return;
            }

            // Allow user to optionally provide data-confirm="Are you sure?"
            if ( link.data('confirm') ) {
                if ( ! laravelDestroy.verifyConfirm(link) ) {
                    return false;
                }
            }

            form = laravelDestroy.createForm(link);
            form.submit();

            e.preventDefault();
        },

        verifyConfirm: function(link) {
            return confirm(link.data('confirm'));
        },

        createForm: function(link) {
            var form =
                $('<form>', {
                    'method': 'POST',
                    'action': link.attr('href')
                });

            var token =
                $('<input>', {
                    'type': 'hidden',
                    'name': '_token',
                    'value': link.data('token')
                });

            var hiddenInput =
                $('<input>', {
                    'name': '_method',
                    'type': 'hidden',
                    'value': link.data('method')
                });
            if(typeof link.data('form') !== 'undefined'){
                var formdata = link.data('form').split('|');
                for(var i =0; i< formdata.length; i++){
                    var inputData = formdata[i].split(':');
                    var input = $('<input>', {
                        'type': 'hidden',
                        'name': inputData[0],
                        'value': inputData[1]
                    });
                    form.append(input);
                }
            }

            return form.append(token, hiddenInput)
                .appendTo('body');
        }
    };

    laravelDestroy.initialize();

})();
