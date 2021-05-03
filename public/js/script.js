const baseURL = "http://localhost:8000";

const getNowURL = () => window.location.href.split("/")[3];

// fungsi umum
const checkTypePetition = (type) => {
    if (type.includes("Berlangsung")) {
        return "berlangsung";
    }
    if (type.includes("Menang")) {
        return "menang";
    }
    if (type.includes("Selesai")) {
        return "selesai";
    }
    if (type.includes("Petisi")) {
        return "petisi_saya";
    }
    if (type.includes("Semua")) {
        return "semua";
    }
    if (type.includes("Dibatalkan")) {
        return "dibatalkan";
    }
    if (type.includes("Belum")) {
        return "belum_valid";
    }
    return "partisipasi";
};

const getStatus = (idStatusEvent) => {
    switch (idStatusEvent) {
        case 0:
            return "not confirmed";
        case 1:
            return "active";
        case 2:
            return "finished";
        case 3:
            return "closed";
        case 4:
            return "canceled";
    }
};

const getACategory = (idCategory) => {
    console.log(idCategory);
    switch (idCategory) {
        case 1:
            return "Pendidikan";
            break;
        case 2:
            return "Bencana Alam";
            break;
        case 3:
            return "Difabel";
            break;
        case 4:
            return "Infrastruktur Umum";
        case 5:
            return "Teknologi";
        case 6:
            return "Budaya";
        case 7:
            return "Karya Kreatif dan Modal Usaha";
        case 8:
            return "Kegiatan Sosial";
        case 9:
            return "Kemanusiaan";
        case 10:
            return "Lingkungan";
        case 11:
            return "Hewan";
        case 12:
            return "Panti Asuhan";
        case 13:
            return "Rumah Ibadah";
        case 14:
            return "Ekonomi";
        case 15:
            return "Politik";
        case 16:
            return "Keadilan";
    }
};

const changeTablePetition = (petition) => {
    return /*html*/ `
    <tr>
        <td>${petition.created_at}</td>
        <td><a href="/petition/${petition.id}">${petition.title}</a></td>
        <td>${getACategory(petition.category)}</td>
        <td>${petition.signedTarget}</td>
        <td>${petition.deadline}</td>
        <td>${getStatus(petition.status)}</td>
    </tr>
        `;
};

const emptyTablePetition = () => {
    return /*html*/ `
    <tr>
        <td colspan="6">Belum ada petisi pada daftar ini</td>
    </tr>
        `;
};

const emptySearchTablePetition = (keyword) => {
    return /*html*/ `
    <tr>
        <td colspan="6">Petisi dengan judul ~${keyword}~ tidak ditemukan</td>
    </tr>
        `;
};

const changeTableDonation = (donation) => {
    return /*html*/ `
    <tr>
        <td>${donation.created_at}</td>
        <td><a href="/donation/${donation.id}">${donation.title}</a></td>
        <td>${donation.category}</td>
        <td>Rp. ${donation.donationTarget.toLocaleString("en")},00</td>
        <td>${donation.deadline}</td>
        <td>${donation.status}</td>
    </tr>
        `;
};

const emptyTableDonation = () => {
    return /*html*/ `
    <tr>
        <td colspan="6">Belum ada donasi pada daftar ini</td>
    </tr>
        `;
};

const emptySearchTableDonation = (keyword) => {
    return /*html*/ `
    <tr>
        <td colspan="6">Donasi dengan judul ~${keyword}~ tidak ditemukan</td>
    </tr>
        `;
};

const emptySearchTableTransaction = (keyword) => {
    return /*html*/ `
    <tr>
        <td colspan="6">Transaksi dengan judul donasi ~${keyword}~ tidak ditemukan</td>
    </tr>
        `;
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

const changeDonationList = (donation) => {
    let collectedNum, collectedDesc;

    if (donation.donationTarget - donation.donationCollected <= 0) {
        collectedNum = donation.donationTarget;
        collectedDesc = "Mencapai Target";
    } else {
        collectedNum = donation.donationTarget - donation.donationCollected;
        collectedDesc = "Menuju Target";
    }

    if (
        Math.ceil(
            (new Date(donation.deadline) - new Date().getTime()) /
                (60 * 60 * 24 * 1000)
        ) > 0
    ) {
        deadline =
            Math.ceil(
                (new Date(donation.deadline) - new Date().getTime()) /
                    (60 * 60 * 24 * 1000)
            ) + " hari lagi";
    } else {
        deadline = "Selesai";
    }

    return /*html*/ `
    <div class="card col-md-4 p-2 mb-3" style="padding: 0; ">
        <div style="position:relative;">
            <img src=${donation.photo} class="img-donation card-img-top"
                alt=" ${donation.title} donation's picture">
            <p class="donate-count">${donation.totalDonatur} Donatur</p>
            <p class="time-left">
                ${deadline}
            </p>
        </div>
        <div class="card-body">
            <h5 class="card-title title-donation"><a href="/donation/${
                donation.id
            }">${donation.title}</a></h5>
            <p class="card-text ">${donation.name}</p>
            <div class="row d-flex justify-content-between">
                <p class="font-weight-bold text-left pl-3">
                    Rp. ${donation.donationCollected.toLocaleString("en")},00
                </p>
                <p class="font-weight-bold text-right">
                    Rp. ${collectedNum.toLocaleString("en")},00
                </p>
            </div>
            <div class="row  d-flex justify-content-between">
                <p class="font-weight-light text-left pl-3 mb-0">Terkumpul</p>
                <p class="font-weight-light text-right pl-1 mb-0">${collectedDesc}</p>
            </div>
        </div>
    </div>
    `;
};

const listDonationEmpty = (keyword) => {
    return /*html*/ `
    <div class="card col-md-12 p-2 mb-3">
        <div class="card-body">
            <h5 class="card-title title-donation">Event donasi dengan judul "${keyword}" tidak ditemukan</h5>
        </div>
    </div>
    `;
};

const noListDonation = () => {
    return /*html*/ `
    <div class="card col-md-12 p-2 mb-3">
        <div class="card-body">
            <h5 class="card-title title-donation">Belum ada donasi pada daftar ini.</h5>
        </div>
    </div>
    `;
};

const sortListPetition = (sortBy, category, typePetition) => {
    const url = getNowURL();

    $.ajax({
        url: "/petition/sort",
        data: { sortBy, category, typePetition },
        dataType: "json",
        success: (data) => {
            let html = "";
            if (data.length != 0) {
                if (url != "admin") {
                    data.forEach((petition) => {
                        html += changePetitionList(petition);
                    });
                } else {
                    data.forEach((petition) => {
                        html += changeTablePetition(petition);
                    });
                }

                $("#petition-list").html(html);
            } else {
                if (url != "admin") {
                    html += listPetitionEmpty();
                } else {
                    html += emptyTablePetition();
                }
                $("#petition-list").html(html);
            }
        },
    });
};

const adminSortListDonation = (sortBy, category, typeDonation) => {
    $.ajax({
        url: "/admin/donation/sort",
        data: { sortBy, category, typeDonation },
        dataType: "json",
        success: (data) => {
            let html = "";
            if (data.length != 0) {
                data.forEach((donation) => {
                    html += changeTableDonation(donation);
                });

                $("#donation-list").html(html);
            } else {
                html += emptyTableDonation();
                $("#donation-list").html(html);
            }
        },
    });
};

const sortListDonation = (sortBy, category) => {
    $.ajax({
        url: "/donation/sort",
        data: { sortBy, category },
        dataType: "json",
        success: (data) => {
            let html = "";
            if (data.length != 0) {
                data.forEach((donation) => {
                    html += changeDonationList(donation);
                });
                $("#donation-list").html(html);
            } else {
                html += noListDonation();
                $("#donation-list").html(html);
            }
        },
    });
};

const changeTableTransaction = (transaction) => {
    let status = "";
    let typeBadge = "";

    if (transaction.status == 0) {
        status = "Perlu Konfirmasi";
        typeBadge = "info";
    } else if (transaction.status == 1) {
        status = "Dikonfirmasi";
        typeBadge = "success";
    } else {
        status = "Ditolak";
        typeBadge = "danger";
    }

    return /*html*/ `
    <tr>
        <td>${transaction.created_at}</td>
        <td>${transaction.title}</td>
        <td>${transaction.name}</td>
        <td>Rp. ${transaction.nominal.toLocaleString("en")},00</td>
        <td><p class="badge badge-${typeBadge}">${status}</p></td>
        <td><a href="/admin/donation/transaction/${
            transaction.id
        }" type="button"
                class="btn btn-primary">detail</a></td>
    </tr>
        `;
};

const emptyTableTransaction = () => {
    return /*html*/ `
    <tr>
        <td colspan="6">Belum ada Transaksi pada daftar ini</td>
    </tr>
        `;
};

// fungsi trigger
//untuk active link sesuai page yang diklik
$(".nav-link").ready(function () {
    let url = getNowURL();

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

$("#check-terms-agreement").on("click", function () {
    if (this.checked) {
        $(".verify-profile").attr("disabled", false);
    } else {
        $(".verify-profile").attr("disabled", true);
    }
});

$("#check-privacy-policy").on("click", function () {
    if (this.checked) {
        $("#sign-petition-button").attr("disabled", false);
    } else {
        $("#sign-petition-button").attr("disabled", true);
    }
});

$(".verification-create-petition").on("click", function () {
    const email = $("#email").val();
    const phone = $("#phone").val();
    const _token = $(this).parent().prev().prev().prev().val();

    $.ajax({
        url: "/petition/create/verification",
        method: "post",
        data: { email, phone, _token },
        dataType: "json",
        success: (checked) => {
            $(".close-dismiss").trigger("click");
            if (checked == "Validation Error") {
                swal(
                    "Verifikasi gagal",
                    "Periksa kembali input Anda.",
                    "error"
                );
            } else if (checked) {
                swal("Berhasil", "Verifikasi Berhasil!", "success");
                console.log($(".new-petition"));
                $(".new-petition").removeAttr("disabled");
            } else {
                swal(
                    "Verifikasi Gagal",
                    `Data dengan email ${email} dan ${phone} tidak ditemukan`,
                    "error"
                );
            }
        },
    });
});

$(".donation-detail").on("click", function () {
    $(".donation-detail").removeClass("active");
    $(this).addClass("active");
});

$(".petition-type").on("click", function () {
    // cari yang ada class btn-primary
    $(".petition-type").removeClass("btn-primary");
    $(".petition-type").addClass("btn-light");

    $(this).addClass("btn-primary");
    $(this).removeClass("btn-light");

    let typePetition = $(this).html();
    typePetition = checkTypePetition(typePetition);

    let url = getNowURL();

    if (url != "admin") {
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
    }

    $.ajax({
        url: "/petition/type",
        data: { typePetition },
        dataType: "json",
        success: (data) => {
            let html = "";
            if (data.length != 0) {
                if (url != "admin") {
                    data.forEach((petition) => {
                        html += changePetitionList(petition);
                    });
                } else {
                    data.forEach((petition) => {
                        html += changeTablePetition(petition);
                    });
                }
                $("#petition-list").html(html);
            } else {
                if (url != "admin") {
                    html += listPetitionEmpty();
                } else {
                    html += emptyTablePetition();
                }

                $("#petition-list").html(html);
            }
        },
    });
});

$("#search-petition").on("keyup", function () {
    let url = getNowURL();
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
                if (url != "admin") {
                    data.forEach((petition) => {
                        html += changePetitionList(petition);
                    });
                } else {
                    data.forEach((petition) => {
                        html += changeTablePetition(petition);
                    });
                }
                $("#petition-list").html(html);
            } else {
                if (url != "admin") {
                    html += listPetitionTypeEmpty(keyword);
                } else {
                    html += emptySearchTablePetition(keyword);
                }

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

    $("#sort-label").html(sortBy);

    let category = $("#category-choosen").val();
    let typePetition = checkTypePetition(
        $(".petition-type.btn-primary").html()
    );
    sortListPetition(sortBy, category, typePetition);
});

$(".category-petition").on("click", function (e) {
    e.preventDefault();
    let category = $(this).html();
    $("#category-choosen").val(category);

    $(".category-petition").removeClass("font-weight-bold");
    $(this).addClass("font-weight-bold");

    $("#category-label").html(category);

    let sortBy = $("#sort-by").val();
    let typePetition = checkTypePetition(
        $(".petition-type.btn-primary").html()
    );
    sortListPetition(sortBy, category, typePetition);
});

// Untuk donasi
$("#search-donation").on("keyup", function () {
    let keyword = $(this).val();
    let category = $("#category-donation-selected").val();
    let sortBy = $("#sort-donation-selected").val();

    if (getNowURL() == "admin") {
        const typeDonation = checkTypePetition(
            $(".donation-type.btn-primary").html()
        );

        $.ajax({
            url: "/admin/donation/search",
            data: { keyword, category, sortBy, typeDonation },
            dataType: "json",
            success: (data) => {
                let html = "";
                if (data.length != 0) {
                    data.forEach((donation) => {
                        html += changeTableDonation(donation);
                    });
                    $("#donation-list").html(html);
                } else {
                    html += emptySearchTableDonation(keyword);
                    $("#donation-list").html(html);
                }
            },
        });
    } else {
        $.ajax({
            url: "/donation/search",
            data: { keyword, category, sortBy },
            dataType: "json",
            success: (data) => {
                let html = "";
                if (data.length != 0) {
                    data.forEach((donation) => {
                        html += changeDonationList(donation);
                    });
                    $("#donation-list").html(html);
                } else {
                    html += listDonationEmpty(keyword);
                    $("#donation-list").html(html);
                }
            },
        });
    }
});

$(".sort-select-donation").on("click", function (e) {
    e.preventDefault();
    let sortBy = $(this).html();
    $("#sort-donation-selected").val(sortBy);

    $(".sort-select-donation").removeClass("active");
    $(this).addClass("active");

    $("#sort-label").html(sortBy);
    let category = $("#category-donation-selected").val();

    if (getNowURL() == "admin") {
        const typeDonation = checkTypePetition(
            $(".donation-type.btn-primary").html()
        );

        adminSortListDonation(sortBy, category, typeDonation);
    } else {
        sortListDonation(sortBy, category);
    }
});

$(".category-select-donation").on("click", function (e) {
    e.preventDefault();
    let category = $(this).html();
    $("#category-donation-selected").val(category);

    $(".category-select-donation").removeClass("active");
    $(this).addClass("active");

    $("#category-label").html(category);
    let sortBy = $("#sort-donation-selected").val();

    if (getNowURL() == "admin") {
        const typeDonation = checkTypePetition(
            $(".donation-type.btn-primary").html()
        );

        adminSortListDonation(sortBy, category, typeDonation);
    } else {
        sortListDonation(sortBy, category);
    }
});

$(".donation-type").on("click", function () {
    // cari yang ada class btn-primary
    $(".donation-type").removeClass("btn-primary");
    $(".donation-type").addClass("btn-light");

    $(this).addClass("btn-primary");
    $(this).removeClass("btn-light");

    let typeDonation = $(this).html();
    typeDonation = checkTypePetition(typeDonation);

    $.ajax({
        url: "/admin/donation/type",
        data: { typeDonation },
        dataType: "json",
        success: (data) => {
            let html = "";
            if (data.length != 0) {
                data.forEach((donation) => {
                    html += changeTableDonation(donation);
                });

                $("#donation-list").html(html);
            } else {
                html += emptyTableDonation();

                $("#donation-list").html(html);
            }
        },
    });
});

$(".show-budgeting").on("click", function () {
    const html = $("#budgeting").html();
    $(".card-text").html(html);
});

$(".show-description").on("click", function () {
    const html = $("#description").html();
    $(".card-text").html(html);
});

$(".show-donatur").on("click", function () {
    const html = $("#donatur").html();
    $(".card-text").html(html);
});

$(".show-comment").on("click", function () {
    const html = $("#comment").html();
    $(".card-text").html(html);
});

$("#repaymentPicture").on("change", function () {
    const cover = document.querySelector("#repaymentPicture");
    const coverLabel = document.querySelector(".custom-file-label");
    const imgPreview = document.querySelector(".img-preview");

    coverLabel.textContent = cover.files[0].name;
    const fileCover = new FileReader();
    fileCover.readAsDataURL(cover.files[0]);
    fileCover.onload = function (e) {
        imgPreview.src = e.target.result;
    };
});

$(".btn-add-allocation").on("click", function () {
    let html = /*html*/ `
    <tr>
        <td scope="row">
            <input type="text" name="nominal[]" placeholder="nominal"
                class="w-100 input-allocation">
        </td>
        <td>
            <input type="text" name="allocationFor[]" placeholder="allocationFor"
                class="w-100 input-allocation">
        </td>
        <td>
            <button type="button"
                class="badge badge-danger badge-pill btn-remove-allocation">remove</button>
        </td>
    </tr>
    `;
    $("#allocation-list").append(html);
});

$(document).on("click", ".btn-remove-allocation", function () {
    $(this).parent().parent().remove();
});

// ADMIN
const viewUserParticipantRole = (user) => {
    console.log("role : " + user.role);
    // console.log("tanggal : " + user.created_at);
    return /*html*/ `
        <tr>
            <td class="text-center">
                ${changeDateFormat(user.created_at)}
            </td>
            <td>
                <a href = "/admin/user/${user.id}" class = "link-user"> ${
        user.name
    }</a>
            </td>
            <td>
                ${user.email}
            </td>
            <td>
                ${user.countEvent}
            </td>
            <td class="text-left">
                    <span class="badge badge-primary p-2">${user.role}</span>
            </td>
        </tr>
    `;
};

const viewUserCampaignerRole = (user) => {
    console.log("role : " + user.role);
    // console.log("tanggal : " + user.created_at);
    return /*html*/ `
        <tr>
            <td class="text-center">
                ${changeDateFormat(user.created_at)}
            </td>
            <td>
                <a href = "/admin/user/${user.id}" class = "link-user"> ${
        user.name
    }</a>
            </td>
            <td>
                ${user.email}
            </td>
            <td>
                ${user.countEvent}
            </td>
            <td class="text-left">
                    <span class="badge badge-success p-2">${user.role}</span>
            </td>
        </tr>
    `;
};

const viewUserPengajuan = (user) => {
    console.log("role : " + user.role);
    // console.log("tanggal : " + user.created_at);
    return /*html*/ `
        <tr>
            <td class="text-center">
                ${changeDateFormat(user.created_at)}
            </td>
            <td>
                <a href = "/admin/user/${user.id}" class = "link-user"> ${user.name}</a>
            </td>
            <td>
                ${user.email}
            </td>
            <td>
                ${user.countEvent}
            </td>
            <td class="text-left">
                    <span class="badge badge-warning p-2">${user.role}</span>
            </td>
        </tr>
    `;
};

const viewUserGuestRole = (user) => {
    console.log("role : " + user.role);
    // console.log("tanggal : " + user.created_at);
    return /*html*/ `
        <tr>
            <td class="text-center">
                ${changeDateFormat(user.created_at)}
            </td>
            <td>
                <a href = "/admin/user/${user.id}" class = "link-user"> ${
        user.name
    }</a>
            </td>
            <td>
                ${user.email}
            </td>
            <td>
                ${user.countEvent}
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
};

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

    $(".role-type").removeClass("btn-role");
    $(this).addClass("btn-role");

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

                for (let i = 0; i < user.length; i++) {
                    if (user[i].role == "participant" && user[i].status != 3) {
                        html += viewUserParticipantRole(
                            user[i],
                            countParticipated[i]
                        );
                    } else if (user[i].role == "campaigner") {
                        html += viewUserCampaignerRole(
                            user[i],
                            countParticipated[i]
                        );
                    } else if (user[i].role == "guest") {
                        html += viewUserGuestRole(
                            user[i],
                            countParticipated[i]
                        );
                    } else if (user[i].role == "participant" && user[i].status == 3){
                        html += viewUserPengajuan(
                            user[i],
                            countParticipated[i]
                        );
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
};

//Mengubah Format tanggal, ex:2019-10-02 ---> 2019/10/02
const changeDateFormat = (date) => {
    if (date != null) {
        var result = date.slice(0, 10);
        var format = result.replace(/-/g, "/");
    } else {
        var format = " ";
    }

    return format;
};

$(".transaction-type").on("click", function () {
    // cari yang ada class btn-primary
    $(".transaction-type").removeClass("btn-primary");
    $(".transaction-type").addClass("btn-light");
    $(this).addClass("btn-primary");
    $(this).removeClass("btn-light");

    let typeTransaction = $(this).html().toLowerCase();

    $.ajax({
        url: "/admin/transaction/type",
        data: { typeTransaction },
        dataType: "json",
        success: (data) => {
            let html = "";
            if (data.length != 0) {
                data.forEach((transaction) => {
                    html += changeTableTransaction(transaction);
                });

                $("#transaction-list").html(html);
            } else {
                html += emptyTableTransaction();

                $("#transaction-list").html(html);
            }
        },
    });
});

$("#search-transaction").on("keyup", function () {
    let keyword = $(this).val();

    const typeTransaction = $(".transaction-type.btn-primary")
        .html()
        .toLowerCase();

    $.ajax({
        url: "/admin/transaction/search",
        data: { keyword, typeTransaction },
        dataType: "json",
        success: (data) => {
            let html = "";
            if (data.length != 0) {
                data.forEach((transaction) => {
                    html += changeTableTransaction(transaction);
                });
                $("#transaction-list").html(html);
            } else {
                html += emptySearchTableTransaction(keyword);
                $("#transaction-list").html(html);
            }
        },
    });
});

// Trigger Tombol Sort, get Perintah
$(".sort-list-user").on("click", function (e) {
    e.preventDefault(); //To Cancel the event
    let sortBy = $(this).html();
    $("#sort-by").val(sortBy);

    $(".sort-list-user").removeClass("btn-sort");
    $(this).addClass("btn-sort");

    $(".sort-list-user").removeClass("font-weight-bold");
    $(this).addClass("font-weight-bold");

    let roleUserType = roleTypeUser($(".btn-role").html());

    console.log("Sort By : ", sortBy);
    console.log("Role User : ", roleUserType);

    sortListUser(sortBy, roleUserType);
});

const sortListUser = (sortBy, roleUserType) => {
    $.ajax({
        url: "/admin/listUser/sort",
        data: { sortBy, roleUserType },
        dataType: "json",
        success: (data) => {
            console.log(data);
            let html = "";
            if (data[1].length != 0) {
                const pengguna = data[0];
                const countEvent = data[1];
                
                for(let i = 0; i < pengguna.length; i++){
                    if(pengguna[i].role == "participant" && pengguna[i].status != 3){
                        html += viewUserParticipantRole(pengguna[i],countEvent[i]);
                    }else if (pengguna[i].role == "campaigner"){
                        html += viewUserCampaignerRole(pengguna[i], countEvent[i]);
                    }else if (pengguna[i].role == "guest"){
                        html += viewUserGuestRole(pengguna[i], countEvent[i]);
                    }else if(pengguna[i].role == "participant" && pengguna[i].status == 3){
                        html += viewUserPengajuan(pengguna[i], countEvent[i]);
                    }
                }

                $("#user-list-role").html(html);
            } else {
                html += viewUserByRoleIsEmpty(roleUserType);
                $("#user-list-role").html(html);
            }
        },
    });
};

$("#search-user").on("keyup", function () {
    let keyword = $(this).val();
    let roleUserType = roleTypeUser($(".btn-role").html());

    // console.log("Keyword : ", keyword, "Role User : ", roleUserType);

    $.ajax({
        url: "/admin/listUser/search",
        data: { keyword, roleUserType },
        dataType: "json",
        success: (data) => {
            console.log(data);
            let html = "";
            if (data.length != 0) {
                data.forEach((user) => {

                    if (user.role == 'participant' && user.status != 3){

                        html += viewUserParticipantRole(user);
                    } else if (user.role == "campaigner") {
                        html += viewUserCampaignerRole(user);
                    } else if (user.role == "guest") {
                        html += viewUserGuestRole(user);
                    }else if(user.role == 'participant' && user.status == 3){
                        html += viewUserPengajuan(user);
                    }
                });
                $("#user-list-role").html(html);
            } else {
                html += viewUserByRoleIsEmpty();
                $("#user-list-role").html(html);
            }
        },
    });
});

$(".diikuti").on("click", function (e) {
    e.preventDefault();

    $(this).removeClass("btn-light");
    $(this).addClass("btn-primary");

    $(".dibuat").removeClass("btn-primary");
    $(".dibuat").removeClass("btn-light");

    const queryString = window.location.pathname;

    const id = queryString.substring(12);

    var status = "DONATION";

    $.ajax({
        url: "/admin/user/diikuti/" + id,
        dataType: "json",
        success: (data) => {
            let html = "";
            // console.log(data);
            data.forEach(function(events){
                if(status == "DONATION"){
                    events.forEach(function(event){
                        // console.log(event);
                        html += makeDonationCardView(event);
                    });
                }else if(status == "PETITION"){
                    events.forEach(function(event){
                        // console.log(event);
                        html += makePetitionCardView(event);
                    });
                }
                status = "PETITION";
            });
            $(".event").html(html);
        },
    });
});

$(".dibuat").on("click", function (e) {
    $(this).removeClass("btn-light");
    $(this).addClass("btn-primary");

    $(".diikuti").removeClass("btn-primary");
    $(".diikuti").removeClass("btn-light");

    const queryString = window.location.pathname;
    console.log(queryString);

    const id = queryString.substring(12,);
    console.log(id);

    var status = "DONATION";

    $.ajax({
        url: "/admin/user/dibuat/" + id,
        dataType: "json",
        success: (data) => {
            let html = "";
            console.log(data);
            data.forEach(function(events){
                if(status == "DONATION"){
                    events.forEach(function(event){
                        // console.log(event);
                        html += makeDonationCardView(event);
                    });
                }else if(status == "PETITION"){
                    events.forEach(function(event){
                        // console.log(event);
                        html += makePetitionCardView(event);
                    });
                }
                status = "PETITION";
            });
            $(".event").html(html);
        },
    });
});

const makeDonationCardView = (event) =>{
    return `
        <div class="m-2">
            <div class="card" style="width: 18rem; position:relative;">
                <img src="/${event.photo}" class="card-img-top" alt="...">
                <p class="time-left">Donation</p>
                <div class="card-body">
                    <h5 class="card-title">${event.title}</h5>
                    <p class="card-text">${event.name}</p>
                    <a href="/donation/${event.id} class="btn btn-primary">Kunjungi event</a>
                </div>
            </div>
        </div>
    `;
};

const makePetitionCardView = (event) =>{
    return `
        <div class="m-2">
            <div class="card" style="width: 18rem; position:relative;">
                <img src="/${event.photo}" class="card-img-top" alt="...">
                <p class="time-left-white">Petition</p>
                <div class="card-body">
                    <h5 class="card-title">${event.title}</h5>
                    <p class="card-text">${event.name}</p>
                    <a href="/petition/${event.id} class="btn btn-primary">Kunjungi event</a>
                </div>
            </div>
        </div>
    `;
};

// $(".terimaPengajuan").on("click", function (){

//     const queryString = window.location.pathname;
//     console.log(queryString);

//     const id = queryString.substring(12,);
//     console.log(id);

//     const name = $(".name").html();
//     console.log(name);


//     $.ajax({
//         url: "/admin/user/terimaPengajuan/" + id,
//         dataType: "json",
//         success: (data) => {
            
//         },
//     });
// });

// $(".tolakPengajuan").on("click", function (){

//     const queryString = window.location.pathname;
//     console.log(queryString);

//     const id = queryString.substring(12,);
//     console.log(id);

//     $.ajax({
//         url: "/admin/user/tolakPengajuan/" + id,
//         dataType: "json",
//         success: (data) => {
//         },
//     });
// });

