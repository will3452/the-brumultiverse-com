<?php

namespace Database\Seeders;

use App\Models\AvatarBase;
use Illuminate\Database\Seeder;

class AvatarBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bases = [
            [
              "group" => "African American",
              "name" => "afam1",
              "gender" => "Female",
              "path" => "Ro7ly7lyCZ6XAMjEiaauXK4ZYXUChmQdy32uYmcL.png",
            ],
            [
              "group" => "African American",
              "name" => "afam2",
              "gender" => "Female",
              "path" => "YVBqkG6TPbk2oR27Zs9q0Yu1GvjOHCCKoglKwHny.png",
            ],
            [
              "group" => "African American",
              "name" => "afam3",
              "gender" => "Female",
              "path" => "vurUr9Yr6hcGO99In4EwIW4lCkf9v5ymiA2WW6ud.png",
            ],
            [
              "group" => "African American",
              "name" => "afam4",
              "gender" => "Female",
              "path" => "wkMb89zVtZ2xbjQQLfP0URbTxdkOb3ghSaVVgPBc.png",
            ],
            [
              "group" => "African American",
              "name" => "afam5",
              "gender" => "Female",
              "path" => "1bb4ee73TbPWVxGR8XoS8wQnPshm0dOButiUF7ko.png",
            ],
            [
              "group" => "African",
              "name" => "af1",
              "gender" => "Female",
              "path" => "08yQeeTeTWOwIh42NEAh3T20KwnAHrbrcrtYFuHM.png",
            ],
            [
              "group" => "African",
              "name" => "af2",
              "gender" => "Female",
              "path" => "8YpQWnRWX5TL3MuDxFDv0qIUi7WJSRGjWSuaAWdh.png",
            ],
            [
              "group" => "African",
              "name" => "af3",
              "gender" => "Female",
              "path" => "B790pz1J2DGybxfscAkIfiKBNe5fUonQaDIgUehI.png",
            ],
            [
              "group" => "African",
              "name" => "af5",
              "gender" => "Female",
              "path" => "SOLOXI0aCiglTWLWXfz6xJtqLxGw90fpRnYzNavg.png",
            ],
            [
              "group" => "Asian",
              "name" => "asda1",
              "gender" => "Female",
              "path" => "wGm3hpu4UPMroJ5knFcaLqzB0DCqJZrvHqCJtEuh.png",
            ],
            [
              "group" => "Asian",
              "name" => "asda2",
              "gender" => "Female",
              "path" => "tOokTmsIgo3ovMEZzF4McXo7A39xIBhTuDT73huT.png",
            ],
            [
              "group" => "Asian",
              "name" => "asda3",
              "gender" => "Female",
              "path" => "Cfxw2DGGTQh3u1lPkZhAnpfEZy187Pc50JEHSxzR.png",
            ],
            [
              "group" => "Asian",
              "name" => "asda4",
              "gender" => "Female",
              "path" => "Qj7mwZXoHw4D9GghJq5FvpFlFk0DOGTvUpnBxJxD.png",
            ],
            [
              "group" => "Asian",
              "name" => "asda5",
              "gender" => "Female",
              "path" => "pP4NRofjjqLPkJFMcLPtUYPpTu1YMXoMaiHvDbBd.png",
            ],
            [
              "group" => "Asian",
              "name" => "asli1",
              "gender" => "Female",
              "path" => "1jBhJxuEn0CWXX3PuhEpZNVNucIwVyOH7hLn9K95.png",
            ],
            [
              "group" => "Asian",
              "name" => "asli2",
              "gender" => "Female",
              "path" => "1pJZHgXp3tVOUdNuIV9QhdJfsdBs4lEO7SjqYD21.png",
            ],
            [
              "group" => "Asian",
              "name" => "asli3",
              "gender" => "Female",
              "path" => "03i99ikspMHQyu1ZyfXYlgxLE3DNaJ7NBTJZ02Up.png",
            ],
            [
              "group" => "Asian",
              "name" => "asli4",
              "gender" => "Female",
              "path" => "L0xyYVG4b90yEMqucf8nLxEnSehvFWWjNL1eKWEM.png",
            ],
            [
              "group" => "Asian",
              "name" => "asli5",
              "gender" => "Female",
              "path" => "d6XIK90r4k0QQgd6EPgAuNcczP5cDuv3AVYD3SeX.png",
            ],
            [
              "group" => "Latin",
              "name" => "latina1",
              "gender" => "Female",
              "path" => "hgIshfOVmXUFS0EY0oQVSgUfFi0maDlkFSIIXKkD.png",
            ],
            [
              "group" => "Latin",
              "name" => "latina2",
              "gender" => "Female",
              "path" => "KXUat3kRhd53J8iNvgfO1KreHaA3l0pWXgIYHOfJ.png",
            ],
            [
              "group" => "Latin",
              "name" => "latina3",
              "gender" => "Female",
              "path" => "TX4AwZXF8aTpXlVcPK3sy6Cuu5yQ7vyhR2CiDDdD.png",
            ],
            [
              "group" => "Latin",
              "name" => "latina4",
              "gender" => "Female",
              "path" => "ztwunqERL0Lyoi3qgoAv0Shqk1SR3ecwVpLwna2J.png",
            ],
            [
              "group" => "Latin",
              "name" => "latina5",
              "gender" => "Female",
              "path" => "TKTeEAV7T6hNBJoqquBSEH1dqHyblwkSUATUpChe.png",
            ],
            [
              "group" => "African",
              "name" => "afda1",
              "gender" => "Male",
              "path" => "2JbsbDSCFZRUZiyH40OHcV80bje8bLE4XwrhxKQR.png",
            ],
            [
              "group" => "African",
              "name" => "afda2",
              "gender" => "Male",
              "path" => "9iPiVT98pTsonCu0zoCJYG2XcWRpnfosoLRdg40x.png",
            ],
            [
              "group" => "African",
              "name" => "afda3",
              "gender" => "Male",
              "path" => "z5wIigfb0XbzfUSxUPb1RIFw8HBNfttU9oz4y7RO.png",
            ],
            [
              "group" => "African",
              "name" => "afli1",
              "gender" => "Male",
              "path" => "BMEGFxNj46IZUstQImetsjwYfgeguX3f1QhSPfok.png",
            ],
            [
              "group" => "African",
              "name" => "afli2",
              "gender" => "Male",
              "path" => "8ODQUVxUdvGfxdcJd6VqnZ8hcEdrJbdKlOkpHt0Z.png",
            ],
            [
              "group" => "African",
              "name" => "afli3",
              "gender" => "Male",
              "path" => "s41kNVKAUyDMGvD35EqPKoMVHX3ZWwiSTJSvGGSj.png",
            ],
            [
              "group" => "Asian",
              "name" => "asda1",
              "gender" => "Male",
              "path" => "6MSdRERSeGLuhbkDNS8YXYrnoBNZXUtFRRWmeBK5.png",
            ],
            [
              "group" => "Asian",
              "name" => "asda2",
              "gender" => "Male",
              "path" => "sd1o7l24xMHSLKLTMa54rwLwoI5HwQa2n9R623lp.png",
            ],
            [
              "group" => "Asian",
              "name" => "asda3",
              "gender" => "Male",
              "path" => "XT5MRVY8SZXOXyir8SGbusMwsGcqxd41gXq7Ophu.png",
            ],
            [
              "group" => "Asian",
              "name" => "asli1",
              "gender" => "Male",
              "path" => "8GBgN9csQQFAsF8zfRy3HvZmm6AOGhIhJMyJzZMU.png",
            ],
            [
              "group" => "Asian",
              "name" => "asli2",
              "gender" => "Male",
              "path" => "TY1GwUX5vpexrP0jsty1t2cqBmlx00x9FPzC12U1.png",
            ],
            [
              "group" => "Asian",
              "name" => "asli3",
              "gender" => "Male",
              "path" => "vFleXPX9NfzJXFC9hcwG2QzjU4jc00mJF4obDlV5.png",
            ],
            [
              "group" => "Latin",
              "name" => "la1",
              "gender" => "Male",
              "path" => "zcwaD6GY3Mb9qnllMB2wRTepjO76UmmzWGa7PBzO.png",
            ],
            [
              "group" => "Latin",
              "name" => "la2",
              "gender" => "Male",
              "path" => "n5pY9uRZZ8Ju8HTshPaI8UMeFpsjkeLneCyb21aX.png",
            ],
            [
              "group" => "Latin",
              "name" => "la3",
              "gender" => "Male",
              "path" => "T9Y8ef40RDBUwhTnpeIalzQBYVwg6CNAx3BkoBKf.png",
            ],
        ];

        foreach ($avatars as $avatar) {
            AvatarBase::create($avatar);
        }
    }
}
