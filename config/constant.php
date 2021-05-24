<?php
//constant data
define("ACCOUNT", "1702272081");
define("DEFAULT_PROFILE", "/images/profile/photo/default.png");
define("DEFAULT_COVER_PROFILE", "/images/profile/background/default-cover-profile.png");
define("DEFAULT_FILE_PREVIEW", "/images/app/pictures/default-file.png");
define("GUEST_ID", 1);
define("MIN_DONATION", 10000);
define("MAX_CHARACTER", 150);
define("MAX_STACK", 6);
define("SIGNED_TARGET_STACK_1", 100);
define("SIGNED_TARGET_STACK_2", 500);
define("SIGNED_TARGET_STACK_3", 1000);
define("SIGNED_TARGET_STACK_4", 10000);
define("SIGNED_TARGET_STACK_5", 50000);
define("SIGNED_TARGET_STACK_6", 100000);

define("FOLDER_IMAGE_PETITION", "images/petition/events/");
define("FOLDER_IMAGE_PETITION_PROGRESS", "images/petition/update_news/");
define("FOLDER_IMAGE_DONATION", "images/donation/");
define("FOLDER_IMAGE_PROFILE", "images/profile/photo/");
define("FOLDER_IMAGE_COVER", "images/profile/background/");
define("FOLDER_IMAGE_TRANSACTION", "images/verification/transaction/");
define("FOLDER_IMAGE_KTP", "images/verification/ktp/");

// Status Event
define("NOT_CONFIRMED", 0);
define("ACTIVE", 1);
define("FINISHED", 2);
define("CLOSED", 3);
define("CANCELED", 4);
define("REJECTED", 5);
define("PROCEEDED", 6);
define("TARGET_REACHED", 7);

// Status User
define("DELETED", 0);
//ACTIVE, 1 -> gunakan yang ada pada status event
define("BLOCKED", 2);
define("WAITING", 3);

// Role User
define("GUEST", "guest");
define("ADMIN", "admin");
define("PARTICIPANT", "participant");
define("CAMPAIGNER", "campaigner");

//event
define("PETITION", "petition");
define("DONATION", "donation");

//petition type
define("BERLANGSUNG", "berlangsung");
define("MENANG", "menang");
define("MENCAPAI_TARGET", "mencapai_target");
define("SELESAI", "selesai");
define("PARTISIPASI", "partisipasi");
define("PETISI_SAYA", "petisi_saya");
define("DIBATALKAN", "dibatalkan");
define("BELUM_VALID", "belum_valid");

//Sort Petition
define("TANDA_TANGAN", "Jumlah Tanda Tangan");
define("EVENT_TERBARU", "Event Terbaru");
define("NONE", "None");

//sort table in petition
define("SIGNED_COLUMN", "signedCollected");
define("CREATED_COLUMN", "created_at");

//Sort donation
define("DEADLINE", "Tenggat Waktu");
define("SMALL_COLLECTED", "Sedikit Terkumpul");
define("MY_DONATION", "Donasi Saya");
define("PARTICIPATED_DONATION", "Ikut Serta");

//sort table in donation
define("DEADLINE_COLUMN", "deadline");
define("COLLECTED_COLUMN", "donationCollected");

//List User Admin
define("PENGAJUAN", "pengajuan");
define("SEMUA", "semua");

//Transaction Type
define("BELUM_UPLOAD", "belum_upload");
define("KONFIRMASI", 'konfirmasi');
define("GAGAL", 'gagal');

// Status Transaction
define("NOT_UPLOADED", 0);
define("CONFIRMED_TRANSACTION", 1);
define("NOT_CONFIRMED_TRANSACTION", 2);
define("REJECTED_TRANSACTION", 3);
