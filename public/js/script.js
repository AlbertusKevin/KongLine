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

    if (typePetition == "Berlangsung") {
        typePetition = "berlangsung";
    } else if (typePetition == "Telah Menang") {
        typePetition = "menang";
    } else if (typePetition == "Petisi Saya") {
        typePetition = "petisi_saya";
    } else {
        typePetition = "partisipasi";
    }

    $.ajax({
        url: "/petisi/type",
        data: { typePetition },
        dataType: "json",
        success: (data) => {
            let html = "";
            if (data.length != 0) {
                data.forEach((petition) => {
                    html +=
                        /*html*/
                        `
                    <div class="card mb-3 ml-auto mr-auto mt-5" style="max-width: 650px;">
                    <div class="row no-gutters">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/petisi/${petition.id}">${petition.title}</a></h5>
                                <p class="card-text">${petition.purpose}</p>
                                <p class="card-text"><small class="text-muted"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-flag-fill mr-2"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                                        </svg><b>${petition.signedCollected} dari ${petition.signedTarget} Orang</b>
                                        telah
                                        menandatangani petisi ini</small></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="/${petition.photo}" alt="Gambar dari petisi '${petition.title}'"
                                class="img-petition">
                        </div>
                    </div>
                </div>
                    `;
                });

                $("#petition-list").html(html);
            } else {
                html +=
                    /*html*/
                    `
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
                $("#petition-list").html(html);
            }
        },
    });
});
