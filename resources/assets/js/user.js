(function($) {

    $(".user-select").select2(
        {
            ajax: {
                url: "/search/user",
                dataType: 'json',
                delay: 250,
                cache: true,
                data: function (params) {
                    return {
                        name: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: $.map(data.users, function (user) {
                            return {
                                text: user.name + " (" + user.email + ")",
                                id: user.id
                            }
                        }),
                        pagination: {
                            more: (params.page * 10) < data.total_count
                        }
                    };
                }
            },
            formatResult: function (data, term) {
                console.log(data);
                return data.name;
            },
        }
    );

})(jQuery);
