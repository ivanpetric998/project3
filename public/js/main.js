function url(str) {
    return baseUrl + "/index.php" + str;
}
const commentsPage = new RegExp(`^${baseUrl}\/[index\.php\/\#]*$`);
const registerPage = new RegExp(`^${baseUrl}\/index\.php\/register[\#]?$`);
const loginPage = new RegExp(`^${baseUrl}\/index\.php\/login[\#]?$`);

$(document).ready(function() {

    if (registerPage.test(window.location.href)) {

        $("#register").click(function() {

            let data = {
                name: $("#name").val(),
                surname: $("#surname").val(),
                username: $("#username").val(),
                password: $("#password").val()
            };

            register(data)

        });
    }

    if (commentsPage.test(window.location.href)) {

        $("#category").change(function() {
            let id = $(this).val();
            getComments(id);
        });

        $("#insert").click(function() {

            let divForMessage = $("#messages");

            let data = {
                category: $("#category").val(),
                text: $("#comment").val(),
                parent: null
            };

            $.ajax({
                url: url("/comments/store"),
                method: "post",
                dataType: "json",
                data: data,
                success: function(data, status, xhr) {

                    if (xhr.status == 201) {
                        getComments($("#category").val());
                        divForMessage.html("Succeful insert a comment");
                        $("#comment").val("");
                    }

                },
                error: function(xhr, status, error) {
                    processAjaxErrors(xhr, divForMessage);
                }
            });
        });

        $(document).on("click", ".subComment", function(e) {

            e.preventDefault();
            $("#hiddenParent").val($(this).data("id"));
            $("#subComment").val("");
            $("#modalMessage").html("");

        });

        $("#insertSubComment").click(function() {

            let divForMessage = $("#modalMessage");

            let data = {
                category: $("#category").val(),
                text: $("#subComment").val(),
                parent: $("#hiddenParent").val()
            };

            $.ajax({
                url: url("/comments/store"),
                method: "post",
                dataType: "json",
                data: data,
                success: function(data, status, xhr) {

                    if (xhr.status == 201) {
                        getComments($("#category").val());
                        $('#commentModal').modal('close');
                    }

                },
                error: function(xhr, status, error) {
                    processAjaxErrors(xhr, divForMessage);
                }
            });
        });

        $('#commentModal').modal();

    }

    if (loginPage.test(window.location.href)) {

    }

    $('.sidenav').sidenav();

});

function getComments(id) {
    $.ajax({
        url: url("/comments/cat"),
        method: "get",
        dataType: "json",
        data: {
            idCat: id
        },
        success: function(data) {
            $("#divForComments").html(printComments(data));
        },
        error: function(xhr, status, error) {
            console.log(xhr.status)
        }
    });
}

function printComments(data, id = null) {
    let print = `<ul class="collection">`;
    let parent = data.filter(p => p.parent == id);
    for (let i of parent) {

        print +=
            `<li class="collection-item avatar">

                <img src="${public}/img/user.png" alt="" class="circle">
                <span class="title">${i.username}</span>
                <p>
                    ${i.text}
                </p>

                <div class="secondary-content">

                    <span class="left-align">
                        <a href="#" class="subComment modal-trigger" data-target="commentModal" data-id=${i.idComment}><i class="material-icons">add</i></a>
                    </span>
                    
                    <span class="right-align">${formatDate(i.date)}</span>
                </div>`;

        print += printComments(data, i.idComment);
        print += `</li>`;
    }

    print += `</ul>`;

    return print;
}

function register(data) {

    let divForMessage = $("#message");

    $.ajax({
        url: url("/user/register"),
        method: "post",
        dataType: "json",
        data: data,
        success: function(data, status, xhr) {

            if (xhr.status == 201) {
                divForMessage.html("Succeful register!");
                clearRegisterForm();
            }

        },
        error: function(xhr, status, error) {
            processAjaxErrors(xhr, divForMessage)
        }
    });

    function clearRegisterForm() {
        $("#name").val('');
        $("#surname").val('');
        $("#username").val('');
        $("#password").val('');
    }
}

function processErrors(errors) {
    let print = `<ul>`;
    for (let i of errors) {
        print += `<li>${i}</li>`;
    }
    print += `</ul>`;
    return print;
}

function formatDate(date) {
    let fullDate = date.split(" ");
    let datum = fullDate[0].split("-");
    let vreme = fullDate[1].split(":");

    return `${datum[2]}-${datum[1]}-${datum[0]} ${vreme[0]}:${vreme[1]}`;
}

function processAjaxErrors(xhr, divForMessage) {
    switch (xhr.status) {
        case 403:
            divForMessage.html("You must be logged");
            break;
        case 422:
            divForMessage.html(processErrors(Object.values(xhr.responseJSON.errors)));
            break;
        case 500:
            divForMessage.html(xhr.responseJSON.error);
            break;
        default:
            break;
    }
}