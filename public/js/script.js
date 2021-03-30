$(window).on('load', request($('.nav-link.sidebar.active')));

$('.nav-link.sidebar').on('click', function (event) {
    event.preventDefault();
    $('.nav-link.sidebar.active').removeClass(' active');
    this.className += ' active';

    request(this);
});

$('#like-btn').on("click", function (event) {
    event.preventDefault();
    $.ajax({
        method: $('#like-form').attr('method'),
        url: $('#like-form').attr('action'),
        data: $('#like-form').serialize(),
        success: function (result) {
            $('#likes').text(result[0]);
            console.log(result)
        },
        error : function (result) {
            console.log('pizdec');
        }
    });
});

$('#dislike-btn').on("click", function (event) {
    event.preventDefault();
    $.ajax({
        method: $('#like-form').attr('method'),
        url: $('#dislike-form').attr('action'),
        data: $('#dislike-form').serialize(),
        success: function (result) {
            $('#likes').text(result[0]);
            console.log(result)
        },
        error : function (result) {
            console.log('pizdec');
        }
    });
});

$('#comment-btn').on('click', function (event) {
    event.preventDefault();
    $.ajax({
        method: $('#comment-form').attr('method'),
        url: $('#comment-form').attr('action'),
        data: $('#comment-form').serialize(),
        success: function (result) {
            let comment = `
                    <div class="card mt-2">
                        <div class="card-header d-flex">
                            <a href="${result[0].user_id}" style="text-decoration: none">
                                <h5 style="color: black">${result[0].user_name}</h5></a>
                                <small class="ms-34">${result[0].created_at}</small>
                        </div>
                        <div class="card-body">
                            <p class="card-text" style="word-break: break-all">${result[0].content}</p>
                        </div>
                    </div>
            `
            $('#comments').prepend(comment);
            console.log(result);
        },
        error: function () {
            console.log('error');
        }
    })
})

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
                             style="position: absolute; bottom: 0; left: 2em">
                            <div class="order-1 p-2 bd-highlight">
                                <small>${result[item].updated}</small></div>
                            <div class="order-3 p-2 bd-highlight"><small>Rating: ${result[item].rating}</small></div>
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
