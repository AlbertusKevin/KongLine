
// fungsi umum
const checkTypePetition = (type) => {
    if (type.includes("Berlangsung")) {
        return "berlangsung";
    }
    if (type.includes("Menang")) {
        return "menang";
    }
    if (type.includes("Petisi")) {
        return "petisi_saya";
    }
    return "partisipasi";
};

const changePetitionList = (petition) => {
    return /*html*/ `
        <div class="card mb-3 ml-auto mr-auto mt-5" style="max-width: 650px;">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><a href="/petition/${petition.id}">${
        petition.title
    }</a></h5>
                    <p class="card-text petition-description">${
                        petition.purpose
                    }</p>
                    <p class="card-text"><small class="text-muted"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-flag-fill mr-2"
                                viewBox="0 0 16 16">
                                <path
                                    d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                            </svg><b>${petition.signedCollected
                                .toString()
                                .replace(
                                    /(\d)(?=(\d{3})+(?!\d))/g,
                                    "$1,"
                                )} dari ${petition.signedTarget
        .toString()
        .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")} Orang</b>
                            telah
                            menandatangani petisi ini</small></p>
                </div>
            </div>
            <div class="col-md-4">
                <img src="/${petition.photo}" alt="Gambar dari petisi '${
        petition.title
    }'"
                    class="img-thumbnail">
            </div>
        </div>
        </div>
        `;
};

const listPetitionEmpty = () => {
    return /*html*/ `
    <div class="card mb-3 ml-auto mr-auto mt-5" style="max-width: 650px;">
        <div class="row no-gutters">
            <div class="col-md-12 text-center">
                <div class="card-body">
                    <h5 class="card-title">Belum ada petisi pada daftar ini</h5>
                </div>
            </div>
        </div>
    </div>
    `;
};

const listPetitionTypeEmpty = (keyword) => {
    return /*html*/ `
    <div class="card mb-3 ml-auto mr-auto mt-5" style="max-width: 650px;">
        <div class="row no-gutters">
            <div class="col-md-12 text-center">
                <div class="card-body">
                    <h5 class="card-title">Tidak terdapat petisi dengan judul ~ ${keyword} ~ pada daftar ini</h5>
                </div>
            </div>
        </div>
    </div>
    `;
};

const sortListPetition = (sortBy, category, typePetition) => {
    $.ajax({
        url: "/petition/sort",
        data: { sortBy, category, typePetition },
        dataType: "json",
        success: (data) => {
            let html = "";
            if (data.length != 0) {
                data.forEach((petition) => {
                    // console.log(petition);
                    html += changePetitionList(petition);
                });
                $("#petition-list").html(html);
            } else {
                html += listPetitionEmpty();
                $("#petition-list").html(html);
            }
        },
    });
};

// fungsi trigger
//untuk active link sesuai page yang diklik
$(".nav-link").ready(function () {
    let url = window.location.href.split("/")[3];

    if (url == "petition") {
        $(".nav-link").each(function () {
            if ($(this).html() == "Petisi") {
                $(this).addClass("active");
            }
        });
    } else if (url == "donation") {
        $(".nav-link").each(function () {
            if ($(this).html() == "Donasi") {
                $(this).addClass("active");
            }
        });
    } else if (url == "forum") {
        $(".nav-link").each(function () {
            if ($(this).html() == "Forum") {
                $(this).addClass("active");
            }
        });
    }
});

//done
$("#check-privacy-policy").on("click", function () {
    if (this.checked) {
        console.log("true");
        $("#sign-petition-button").attr("disabled", false);
    } else {
        console.log("false");
        $("#sign-petition-button").attr("disabled", true);
    }
});

$(".petition-type").on("click", function () {
    // cari yang ada class btn-primary
    $(".petition-type").removeClass("btn-primary");
    $(".petition-type").addClass("btn-light");

    $(this).addClass("btn-primary");
    $(this).removeClass("btn-light");

    let typePetition = $(this).html();
    typePetition = checkTypePetition(typePetition);
    // console.log(typePetition);

    if (typePetition == "berlangsung") {
        $(".petition-page-title").html("Daftar Petisi");
        $(".petition-page-subtitle").html(
            "Lihat Petisi yang Sedang Berlangsung di Website"
        );
    } else if (typePetition == "menang") {
        $(".petition-page-title").html("Kemenangan Petisi");
        $(".petition-page-subtitle").html(
            "Lihat petisi yang telah menang dan mengubah dunia"
        );
    } else if (typePetition == "petisi_saya") {
        $(".petition-page-title").html("Daftar Petisi Saya");
        $(".petition-page-subtitle").html(
            "Lihat Petisi yang Telah Saya Buat di Website Ini"
        );
    } else {
        $(".petition-page-title").html("Daftar Ikut Serta Petisi");
        $(".petition-page-subtitle").html(
            "Lihat Petisi yang Telah Saya Tandatangani di Website Ini"
        );
    }

    console.log(typePetition);

    $.ajax({
        url: "/petition/type",
        data: { typePetition },
        dataType: "json",
        success: (data) => {
            console.log(data);
            let html = "";
            if (data.length != 0) {
                data.forEach((petition) => {
                    html += changePetitionList(petition);
                });
                $("#petition-list").html(html);
            } else {
                html += listPetitionEmpty();
                $("#petition-list").html(html);
            }
        },
    });
});

$("#search-petition").on("keyup", function () {
    let keyword = $(this).val();
    let typePetition = $(".btn-primary").html();
    let category = $("#category-choosen").val();
    let sortBy = $("#sort-by").val();

    typePetition = checkTypePetition(typePetition);

    $.ajax({
        url: "/petition/search",
        data: { keyword, typePetition, category, sortBy },
        dataType: "json",
        success: (data) => {
            let html = "";
            if (data.length != 0) {
                data.forEach((petition) => {
                    html += changePetitionList(petition);
                });
                $("#petition-list").html(html);
            } else {
                html += listPetitionTypeEmpty(keyword);
                $("#petition-list").html(html);
            }
        },
    });
});

$(".sort-petition").on("click", function (e) {
    e.preventDefault();
    let sortBy = $(this).html();
    $("#sort-by").val(sortBy);

    $(".sort-petition").removeClass("font-weight-bold");
    $(this).addClass("font-weight-bold");

    let category = $("#category-choosen").val();
    let typePetition = checkTypePetition($(".btn-primary").html());
    sortListPetition(sortBy, category, typePetition);
});

$(".category-petition").on("click", function (e) {
    e.preventDefault();
    let category = $(this).html();
    $("#category-choosen").val(category);

    $(".category-petition").removeClass("font-weight-bold");
    $(this).addClass("font-weight-bold");

    let sortBy = $("#sort-by").val();
    let typePetition = checkTypePetition($(".btn-primary").html());
    sortListPetition(sortBy, category, typePetition);
});

// ADMIN

const viewUserParticipantRole = (user, countParticipated) => {
    console.log("role : " + user.role);
    // console.log("tanggal : " + user.created_at);
    return /*html*/ `
        <tr>
            <td class="text-center">
                ${changeDateFormat(user.created_at)}
            </td>
            <td>
                ${user.name}
            </td>
            <td>
                ${user.email}
            </td>
            <td>
                ${countParticipated[1]}
            </td>
            <td class="text-left">
                    <span class="badge badge-primary p-2">${user.role}</span>
            </td>
        </tr>
    `;
};

const viewUserCampaignerRole = (user, countParticipated) => {
    console.log("role : " + user.role);
    // console.log("tanggal : " + user.created_at);
    return /*html*/ `
        <tr>
            <td class="text-center">
                ${changeDateFormat(user.created_at)}
            </td>
            <td>
                ${user.name}
            </td>
            <td>
                ${user.email}
            </td>
            <td>
                ${countParticipated[1]}
            </td>
            <td class="text-left">
                    <span class="badge badge-success p-2">${user.role}</span>
            </td>
        </tr>
    `;
};

const viewUserGuestRole = (user, countParticipated) => {
    console.log("role : " + user.role);
    // console.log("tanggal : " + user.created_at);
    return /*html*/ `
        <tr>
            <td class="text-center">
                ${changeDateFormat(user.created_at)}
            </td>
            <td>
                ${user.name}
            </td>
            <td>
                ${user.email}
            </td>
            <td>
                ${countParticipated[1]}
            </td>
            <td class="text-left">
                    <span class="badge badge-dark p-2">${user.role}</span>
            </td>
        </tr>
    `;
};

const viewUserByRoleIsEmpty = (roleType) => {
    return /* html */ `
        <tr>
            <td colspan = "5" class="text-center">
                Maaf, tidak ada data user ${roleType}
            </td>
        </tr>
    `;
}

const roleTypeUser = (type) => {
    if (type.includes("Participant")) {
        return "participant";
    }
    if (type.includes("Campaigner")) {
        return "campaigner";
    }
    if (type.includes("Pengajuan")) {
        return "pengajuan";
    }
    return "semua";
};

$(".role-type").on("click", function () {
    // cari yang ada class btn-primary
    $(".role-type").removeClass("btn-primary");
    $(".role-type").addClass("btn-light");

    $(this).addClass("btn-primary");
    $(this).removeClass("btn-light");

    let roleType = $(this).html();
    roleType = roleTypeUser(roleType);
    console.log(roleType);

    $.ajax({
        url: "/admin/listUser/role",
        data: { roleType },
        dataType: "json",
        success: (data) => {
            console.log(data);
            let html = "";
            if (data[1].length != 0) {
                const user = data[0];
                const countParticipated = data[1];

                for (let i = 0; i < user.length; i++){
                    if(user[i].role == "participant"){
                        html += viewUserParticipantRole(user[i],countParticipated[i]);
                    }else if (user[i].role == "campaigner"){
                        html += viewUserCampaignerRole(user[i], countParticipated[i]);
                    }else if (user[i].role == "guest"){
                        html += viewUserGuestRole(user[i], countParticipated[i]);
                    }else{

                    }
                }

                $("#user-list-role").html(html);
            } else {
                html += viewUserByRoleIsEmpty(roleType);
                $("#user-list-role").html(html);
            }
        },
    });
    
});

const countEventParticipate = (userId) => {
    console.log(userId);

    $.ajax({
        url: "/admin/listUser/countEvent",
        data: { userId },
        dataType: "json",
        success: (data) => {
            console.log(data);
            return data;
        },
    });
}

//Mengubah Format tanggal, ex:2019-10-02 ---> 2019/10/02
const changeDateFormat = (date) => {

    if(date != null){
        var result = date.slice(0, 10);
        var format = result.replace(/-/g,"/");
    }else{
        var format = " ";
    }
    
    return format;
}

// Menghitung jumlah partisipasi setiap user
