export default {
    init: (app) => {

        /*
        |
        | Constants
        |------------
        */
        const
            $body = $('body'),
            $postsContainer = $('.loaded-posts'),
            $itemFilter = $('.item-filter'),
            $loadMoreContainer = $('.load-more-container'),
            $loadMore = $('.load-more'),
            $loadingContainer = $('.loading-container'),
            $total = $('.card-article').length,
            lang = $body.data('lang'),
            $limit = 9
            ;

        /*
        |
        | Variables
        |------------
        */
        let
            xhr = null,
            state = {
                categoryId: 'all',
                categoryName: null,
                offset: $total
            }
            ;


        if ($total < $limit) {
            $loadMoreContainer.hide()
        }

        /*
        |
        | Filtering
        |-----------
        */
        $itemFilter.on('click', function (e) {

            const $item = $(this)
            $itemFilter.removeClass('active')
            $item.addClass('active')

            state.categoryId = $item.data('category-id')
            state.categoryName = $item.text()
            ajaxFilter()
        });

        /*
        |
        | load more
        |------------
        */
        $loadMore.on('click', function (e) {
            state.offset = $('.card-article').length
            ajaxFilter('loadMore')
        })


        function ajaxFilter(mode = 'filter') {
            if (xhr !== null) {
                xhr.abort()
            }

            const loadmore = mode === 'loadMore';
            const offset = loadmore ? state.offset : 0;

            const route = `/ajax/posts/category/${state.categoryId}/${offset}/${lang}`

            xhr = $.ajax({
                url: route,
                type: 'GET',
                dataType: 'json',
                beforeSend: () => {
                    if (!loadmore) {
                        $postsContainer.fadeOut(200, function () {
                            $(this).html('')
                        })
                    }
                    $loadMoreContainer.show()
                    $loadMore.hide()
                    $loadingContainer.show()
                },
                success: (response, status) => {

                    $loadingContainer.hide()

                    if (!loadmore) {
                        $postsContainer.fadeIn(200, function () {
                            $(this).html(response).show()
                        })
                    } else {
                        $postsContainer.append(response);

                        if (!$postsContainer.find('.no-more-post').length) {
                            $loadMoreContainer.show()
                            $loadMore.show()
                        } else {
                            $loadMoreContainer.hide()
                        }
                    }

                    xhr = null;
                },
                complete: function (response) {

                    setTimeout(() => {
                        window.lazy.update()

                        if (!loadmore) {
                            const $newPosts = $postsContainer.find('.card-article').length
                            if ($newPosts < $limit) {
                                $loadMoreContainer.hide()
                            } else {
                                $loadMoreContainer.show()
                                $loadMore.show()
                            }
                        }
                    }, 400)

                },
                error: (response, status, error) => {
                    console.log(response, status, error)
                }
            })
        }
    }
}