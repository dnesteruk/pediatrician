jQuery(document).ready(function ($) {
    $('#speaker-filter').on('change', function (event) {
        $("#" + event.target.id).toggleClass('active');
        amid_activity_counter()
    });

    function amid_activity_counter($flag = false) {
        let $page = 1;
        let $active = {};
        let $terms = $('#speaker-filter').find('.active');

        if ($terms.length) {

            $.each($terms, function (index, term) {
                if (term.name in $active) {
                    $active[term.name].push(term.value);
                } else {
                    $active[term.name] = [];
                    $active[term.name].push(term.value);
                }
            });

        }
        if ($flag) {
            let $container = $('.speakers-content-container');
            let $btnLoad = $container.find('#speakers-btn-load');
            $page = parseInt($btnLoad.attr('href').replace(/\D/g, ''));
        }

        amid_speakers($active, $page)
    }

    function amid_speakers($active = {}, $page) {

        let $all = 1;
        if ($.isEmptyObject($active)) {
            $all = 0;
        }

        let $params = {
            'page': $page,
            'terms': $active,
            'quantity': $('#speakers-filter-container').data('paged'),
            'all': $all,
        };

        amid_action_ajax_cpt_filter($params)
    }

    // Ajax
    function amid_action_ajax_cpt_filter($params) {
        let $container = $('#speakers-content-container');
        let $content = $container.find('#response');
        let $btn = $container.find('#speakers-btn-load');
        let $status = $('#speakers-filter-container').find('#status');

        $.ajax({
            url: card_ajax.url,
            data: {
                action: 'amid_cpt_filter_query_posts',
                nonce: card_ajax.nonce,
                params: $params,
            },
            type: 'post',
            dataType: 'json',
            beforeSend: function (xhr) {
                $status.text('Processing...');
            },
            success: function (data) {
                if (data.status === 200) {
                    if ($params.page === 1) {
                        $status.text(data.message);
                        $content.html(data.content);
                    } else {
                        $status.text(data.message);
                        $content.append(data.content);
                    }

                    $btn.attr('href', '#page-' + data.next)

                } else if (data.status === 201) {
                    $status.text(data.message);
                    $content.html(data.message);
                }

                if (data.found < data.quantity || data.current_page === data.total) {
                    $btn.css("display", "none");
                } else {
                    $btn.css("display", "inline-block");
                }
            },
            error: function (MLHttpRequest, textStatus, errorThrown) {

                //console.log(MLHttpRequest, textStatus, errorThrown)
            },
        });

    }

    $('#speakers-btn-load').click(function (event) {
        event.preventDefault();
        amid_activity_counter(true)
    });

    amid_activity_counter()
});
