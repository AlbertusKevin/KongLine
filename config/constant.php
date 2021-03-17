<?php

namespace App\Config\Constant;

// Status Event
define("NOT_CONFIRMED", 0);
define("ACTIVE", 1);
define("FINISHED", 2);
define("CLOSED", 3);
define("CANCELED", 4);

// Status User
define("DELETED", 0);
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

//event type
define("BERLANGSUNG", "berlangsung");
define("MENANG", "menang");
define("PARTISIPASI", "partisipasi");
define("PETISI_SAYA", "petisi_saya");

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
