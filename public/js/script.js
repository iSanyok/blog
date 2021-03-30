$(window).on('load', request($('.nav-link.sidebar.active')));

$('.nav-link.sidebar').on('click', function (event) {
    event.preventDefault();
    $('.nav-link.sidebar.active').removeClass(' active');
    this.className += ' active';

    request(this);
});

function request(item) {
    $.ajax({
        method: "GET",
        url: $(item).attr("href"),
        success: function (result) {
            $('div').remove('#articles');
            $('#msg').remove();
            console.log(result);
            if (result.length === 0) {
                $('#sidebar').append('<h5 id="msg">There were no articles today</h5>');
            }
            $.each(result, function (item) {
                $('#sidebar').append(`
                <div class="row g-0 bg-gray position-relative mb-3" id="articles" style="border-radius: 10px">
                    <div class="col-md-6 mb-md-0 p-md-4">
                        <img src="${result[item].banner}" class="w-100" alt="...">
                    </div>
                <div class="col-md-6 p-4 ps-md-0" style="position: relative">
                    <h5 class="mt-0">${result[item].title}</h5>
                    <p>${result[item].description}</p>
                    <a href="/article/show/${result[item].id}" class="stretched-link"
                       style="text-decoration: none; color: dimgray">
                        <div class="d-flex flex-nowrap bd-highlight align-self-end "
                             style="position: absolute; bottom: 0; left: 3em">
                            <div class="order-1 p-2 bd-highlight">
                                <small>${result[item].updated}</small></div>
                            <div class="order-3 p-2 bd-highlight"><small>Likes: ${result[item].likes}</small></div>
                        </div>
                    </a>
                </div>
            </div>
                `);
            });
        },
        error: function (result) {
            console.log('error');
        }
    });
}
