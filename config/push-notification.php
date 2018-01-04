<?php

return array(

    'IOS'     => array(
        'environment' =>'development',
        'certificate' =>'/path/to/certificate.pem',
        'passPhrase'  =>'password',
        'service'     =>'apns'
    ),
    'android' => array(
        'environment' =>'production',
        'apiKey'      =>'AAAAQONsqjY:APA91bHJ3mnLJ6DeUkmbYohsoqSp4gkQ7ZfhBpTRmR1sOR91mryQUkYuImgfJ-CIcrrznGCHKTZYt4VDdxGHz6UrU2O2kejWLk6gaQVfD1EsZQRFw7ntwg-sookY5F2ZIpR3dUAJbYpo',
        'service'     =>'gcm'
    )

);