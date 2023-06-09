<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('movies')->insert([
      'title' => 'Avatar',
      'poster' => 'images/k1nzCGjw48cStwIovx0kuVN1A81zxUAOqFTD0MC6.jpg',
      'banner' => 'images/qfiApqiHCSD7syXwa6D5vkSNFVc2247klbdrUhq5.jpg',
      'year' => 2009,
      'runtime' => 162,
      'plot' => 'AVATAR nos lleva a un mundo situado más allá de la imaginación, en donde un recién llegado de la Tierra se embarca en una aventura épica, llegando a luchar, al final, por salvar el extraño mundo al que ha aprendido a llamar su hogar. James Cameron, el oscarizado director de "Titanic" imaginó por primera vez la película hace quince años, cuando los medios para llevar a cabo y plasmar su visión todavía eran inexistentes.',
      'director' => 'James Cameron',
      'file' => 'media/PmrQlXdn6NlSbeLqAYyQi12wg40MTjQ70m4AfbFn.mp4',
      'trailer' => 'trailer/Z6pDLp9Maz0SIboBDxpczSiAQ9assTDS24gTDZxM.mp4',
      'created_at' => '2023/01/30',
      'price' => 4.99
    ]);

    DB::table('movies')->insert([
      'title' => 'Soy leyenda',
      'poster' => 'images/V4tA2hTaFwR6o2DXSpZYUad5eyR9taRqDdrSerIu.jpg',
      'banner' => 'images/TVi90emZt91OHGlPZ6W1L4UJlLgDzNzHKFVRJfs0.jpg',
      'year' => 2007,
      'runtime' => 101,
      'plot' => 'Años después de que una plaga mate a la mayor parte de la humanidad y transforme al resto en monstruos, el único sobreviviente en la ciudad de Nueva York lucha valientemente para encontrar una cura.',
      'director' => 'Francis Lawrence',
      'file' => 'media/hCkrTQ0D98foZSoh0daWZQoOoAONDQZlWFb6amT6.mp4',
      'trailer' => 'trailer/R8yyxGfMNkyXtse1X48zKHyliiM7sLKG62SKHGJh.mp4',
      'created_at' => '2023/02/28',
      'price' => 4.99
    ]);

    DB::table('movies')->insert([
      'title' => '300',
      'poster' => 'images/sm7DtS3hd4nkbbYjhNbhx9s0OyJDtC4yajjHpk8b.jpg',
      'banner' => 'images/Y9JCHmONmE9vAlnHCzzKV4nqSYSlYhDODXdeYIPZ.jpg',
      'year' => 2006,
      'runtime' => 117,
      'plot' => 'El rey Leónidas de Esparta y una fuerza de 300 hombres luchan contra los persas en las Termópilas en el 480 a.C.',
      'director' => 'Zack Snyder',
      'file' => 'media/Tol2MOGMJmyAJjJNjsPqjZIHqb8uohVcTn2abVNF.mp4',
      'trailer' => 'trailer/zDvIh33yREbwoI7VhSD0RTWcIJbdXuYT8parTF6r.mp4',
      'created_at' => '2023/03/30',
      'price' => 4.99
    ]);

    DB::table('movies')->insert([
      'title' => 'Bullet Train',
      'poster' => 'images/U3TneD4zqEQNZTKxRGEXRY0uyAxU72Ru2438nB6T.jpg',
      'banner' => 'images/A4bBCNxE9nbKfzKBq5wbXPfymsEoa25ZxWmLZmUb.jpg',
      'year' => 2022,
      'runtime' => 126,
      'plot' => 'Cinco asesinos a sueldo se encuentran a bordo de un tren bala que viaja de Tokio a Morioka. Los sicarios descubrirán que sus misiones no son ajenas entre sí.',
      'director' => 'David Leitch',
      'file' => 'media/lqRGBo8HkYS4lymCbAQ3CQjGwO6Oavo6JyzYvIHs.mp4',
      'trailer' => 'trailer/jfUy9WYuVccWYyrR1nuddErOtflrvemXa71z5XdA.mp4',
      'created_at' => '2023-04-11 08:50:32',
      'price' => 14.99
    ]);

    DB::table('movies')->insert([
      'title' => 'Uncharted',
      'poster' => 'images/CHmAiS7zybXoWEQxp0e3HpkDzCe1D9X1VTucsggT.jpg',
      'banner' => 'images/wjI86VPJ4zhqKWBwEkLo2OEC5lxzeCeRbEsi647A.jpg',
      'year' => 2022,
      'runtime' => 95,
      'plot' => 'Nathan Drake y su compañero Victor Sullivan se adentran en la peligrosa búsqueda del "mayor tesoro jamás encontrado". Al mismo tiempo, rastrean pistas que puedan conducir al hermano perdido de Drake.',
      'director' => 'Ruben Fleischer',
      'file' => 'media/fC5Xzm7vsO22t72ncv2uhgPVT3Cbbh6hVPaXQomK.mp4',
      'trailer' => 'trailer/12Z2fJ2JBpPgZU0JmRtP1T4vMMdBWRvadkKNehSb.mp4',
      'created_at' => '2023-04-11 09:12:53',
      'price' => 14.99
    ]);

    DB::table('movies')->insert([
      'title' => 'Black Adam',
      'poster' => 'images/DZm6vyLOuwbKyEcd02qdSycG2iXD3mThLeAH09y4.jpg',
      'banner' => 'images/y5FI4ZZpzx1Yhkr2treFlohHhZEk3RzUQC0xwEXn.jpg',
      'year' => 2022,
      'runtime' => 125,
      'plot' => 'Unos arqueólogos liberan de su tumba a Black Adam, quien llevaba 5000 años preso tras haber recibido los poderes de los dioses. De nuevo entre los humanos, Black Adam se dispone a imponer su justicia, muy diferente a la del mundo en el que despertó.',
      'director' => 'Jaume Collet-Serra',
      'file' => 'media/aH7rkF7rDUAvWWBop0I235Ke47WuKpkgSVZePMQ9.mp4',
      'trailer' => 'trailer/gLxHu00BjBIvc5aQEtXoGiI9lvoi30zVjB6Dbkd0.mp4',
      'created_at' => '2023-04-11 09:14:56',
      'price' => 14.99
    ]);

    DB::table('movies')->insert([
      'title' => 'The Gray Man',
      'poster' => 'images/8aLYuxa3DKreaQ1eX4L89ShZwrbmry9JUzohoP8C.jpg',
      'banner' => 'images/4uFkBGbuvxG9xCnhH3tY2Ewyizm3o5PmA6MzdQKm.jpg',
      'year' => 2022,
      'runtime' => 122,
      'plot' => 'Cuando un misterioso agente de la CIA descubre trapos sucios de la Agencia, un excompañero desquiciado pone precio a su cabeza y lo persigue por todo el mundo.',
      'director' => 'Joe Russo y Anthony Russo',
      'file' => 'media/3MlLWWdV0QUWanvvwhadiC8bCxJiRX044fcQABAC.mp4',
      'trailer' => 'trailer/aUQN7Pn6bFe9BqbSzTzvobb1KbUdxHSFtMD1BSn8.mp4',
      'created_at' => '2023-04-11 09:19:49',
      'price' => 14.99
    ]);

    DB::table('movies')->insert([
      'title' => 'Jurassic World: Dominion',
      'poster' => 'images/Ra2LEINzaTnSmJBvb7nmOwLlG7vKd3zbOHM69Sxf.jpg',
      'banner' => 'images/431rQ8RBx3UIlMI6qAJWN3GimNPsV4xjUR5FjNwN.jpg',
      'year' => 2022,
      'runtime' => 86,
      'plot' => 'Cuatro años después de la destrucción de la Isla Nublar, los dinosaurios viven y cazan junto a los humanos en todo el mundo. Este frágil equilibrio remodelará el futuro y determinará si los humanos seguirán siendo o no la especie dominante.',
      'director' => 'Colin Trevorrow',
      'file' => 'media/2qflyUoCLi2hXu3o42zyK9AVbU43JJaTV5VFn3YA.mp4',
      'trailer' => 'trailer/i17ec1yJQFJHPU7zU3WWUEUz7lXiHa7UcDhAGAnC.mp4',
      'created_at' => '2023-04-11 09:27:59',
      'price' => 14.99
    ]);

    DB::table('movies')->insert([
      'title' => 'El hombre del norte',
      'poster' => 'images/C1L1N6MFqEUiCEkWIrYYmEvm6zXTznHAOm8Q5KO6.jpg',
      'banner' => 'images/iQ6PB6vGj0tpoahOYeuk9A8SLR9fB6VRDHTHSZFi.jpg',
      'year' => 2022,
      'runtime' => 120,
      'plot' => 'El príncipe Amleth está a punto de convertirse en hombre pero, en ese momento, su tío asesina brutalmente a su padre y secuestra a la madre del niño. Dos décadas después, Amleth es un vikingo que tiene la misión de salvar a su madre.',
      'director' => 'Robert Eggers',
      'file' => 'media/yMlE19UqGAvBD8iUgFe5eqUmVzPy0BWsMpqa1FHu.mp4',
      'trailer' => 'trailer/nMK9u25UI4TcMykpaODxabz94a2J7h8CkwioJ8cB.mp4',
      'created_at' => '2023-04-11 09:31:01',
      'price' => 14.99
    ]);

    DB::table('movies')->insert([
        'title' => 'Spider-Man: No Way Home',
        'poster' => 'images/3GwkNVxiyDdarICcSJLxbJ8r2QKpjpD2BC7GHibJ.jpg',
        'banner' => 'images/E5TqV66PVeP8WzgV930bxPHAKE2q4n0gtThXozIH.jpg',
        'year' => 2021,
        'runtime' => 148,
        'plot' => 'Esta versión extendida cuenta con más de 11 minutos contenido extra, incluyendo escenas eliminadas.Por primera vez en la historia cinematográfica de Spider-Man, nuestro héroe, vecino y amigo es desenmascarado y por tanto ya no es capaz de separar su vida normal de los enormes riesgos que conlleva ser un Súper Héroe. Cuando pide ayuda a Doctor Strange, los riesgos pasan a ser aún más peligrosos, obligándole a descubrir lo que realmente significa ser Spider-Man.',
        'director' => 'Jon Watts',
        'file' => 'media/yNW2TFNNkKIOFDaaaPiR5EehuxSuVaBB8FIG1DUn.mp4',
        'trailer' => 'trailer/gTqfiG7Aroc8kpTEPNdUI5qkYFTlcqLrKCtFSHbm.mp4',
        'created_at' => '2023-04-11 09:33:54',
        'price' => 10.99
      ]);

    DB::table('movies')->insert([
        'title' => 'Top Gun: Maverick',
        'poster' => 'images/aepn1R8rUAsAWheoq374D2viH9ccF6BPMKbOt5Ta.jpg',
        'banner' => 'images/zP2hiEopVqaNEiFWl5zsmRTlACyku1VZgows89R8.jpg',
        'year' => 2022,
        'runtime' => 130,
        'plot' => 'Tras más de 30 años de servicio como uno de los mejores aviadores de la Armada, Pete "Maverick" Mitchel se encuentra donde siempre quiso estar, empujando los límites como un valiente piloto de pruebas.',
        'director' => 'Joseph Kosinski',
        'file' => 'media/bLstkPI9fyVqy3Sn5bqGlzT1FEDG97xo3FgOBbV0.mp4',
        'trailer' => 'trailer/k1W4bz3e93NbbKJvdCfLP8Qx4wsYoLCebwqox2tL.mp4',
        'created_at' => '2023-04-11 09:36:31',
        'price' => 14.99
      ]);

    DB::table('movies')->insert([
        'title' => 'Morbius',
        'poster' => 'images/gJ8tXXuP1nzXkKKUiNeyOz0Y4lV5xZ5HXpS0lNhB.jpg',
        'banner' => 'images/5qrGzWxg4A95Kk93K0kudTlQHOn6aFWbfjQTWkKU.jpg',
        'year' => 2022,
        'runtime' => 104,
        'plot' => 'Ambientada en el universo de Spider Man, se centra en uno de sus villanos más icónicos, Morbius, un doctor que tras sufrir una enfermedad en la sangre y fallar al intentar curarse, se convirtió en un vampiro.',
        'director' => 'Daniel Espinosa',
        'file' => 'media/ICjdraunJiJMamYEmfbt0EJDkSBL3a6aOpdh4tct.mp4',
        'trailer' => 'trailer/uZFOXg6jaPoc7d1K6itLbKiObhBwokYRqNyyp7YQ.mp4',
        'created_at' => '2023-04-11 09:37:51',
        'price' => 4.99
      ]);

    DB::table('movies')->insert([
        'title' => 'Infinite Storm',
        'poster' => 'images/LsegJNtpwrxjnKNk0VPOUyWd5tzyUuAUznUcbaar.jpg',
        'banner' => 'images/78CMFHt9QuGKU2RGCH267XI4Il7O34KJhG3VgwKh.jpg',
        'year' => 2022,
        'runtime' => 97,
        'plot' => 'Una alpinista empieza el descenso antes de alcanzar la cumbre porque se avecina una tormenta de nieve. En el camino, encuentra a un hombre en peligro de muerte y, juntos, tratan de llegar vivos al pie de la montaña en unas condiciones infernales.',
        'director' => 'Malgorzata Szumowska y Michal Englert',
        'file' => 'media/AXf80L5Xfz21TI7giLJyXhueCpefjHXSds8OQtjQ.mp4',
        'trailer' => 'trailer/DbBNlhnV9us3jAEaE1Av9ROrCs69VPCgu2uM3CGv.mp4',
        'created_at' => '2023-04-11 11:16:13',
        'price' => 14.99
      ]);

    DB::table('movies')->insert([
        'title' => 'Beast',
        'poster' => 'images/wykfnv406KbWzh4QrTlVTNkUCXHcutq28JEjqLD7.jpg',
        'banner' => 'images/HCSHeB6vhSLARLUolC2jShzSQS78Lkktnhrad8t6.jpg',
        'year' => 2022,
        'runtime' => 93,
        'plot' => 'Un hombre que acaba de enviudar y sus dos hijas adolescentes viajan a una reserva de caza en Sudáfrica. Sin embargo, su viaje de curación pronto se convierte en una lucha por la supervivencia cuando un león sediento de sangre comienza a acecharlos.',
        'director' => 'Baltasar Kormákur',
        'file' => 'media/IxWuN1vStZyxwCc9fPYBbxcTXBjf5RAMvt5Yw4Ud.mp4',
        'trailer' => 'trailer/XGkFiCrAfD0phgrijWqsHoM0u67s2AlXEr2RBwom.mp4',
        'created_at' => '2023-04-11 11:19:58',
        'price' => 14.99
      ]);

    DB::table('movies')->insert([
        'title' => 'Animales Fantásticos',
        'poster' => 'images/3mnQgyKQBGBfYSGmlKFvGFQp29ghp1d3McfDe274.jpg',
        'banner' => 'images/pigxF5VdnO3s8t5ToJiVyCdX74CO3Iqy9B2hnaO2.jpg',
        'year' => 2022,
        'runtime' => 120,
        'plot' => 'La historia tiene lugar en Río de Janeiro, Brasil y conduce a la participación del Mundo Mágico en la Segunda Guerra Mundial.',
        'director' => 'David Yates',
        'file' => 'media/jXjYbdQ9vdZ99j027PAiS0or1Dl7kTpLNgq9drZE.mp4',
        'trailer' => 'trailer/0DdI8HCmtlDSCikgCc8CXOvLTmqioqdIyDLkCtVp.mp4',
        'created_at' => '2023-04-11 11:22:54',
        'price' => 14.99
      ]);

    DB::table('movies')->insert([
        'title' => 'Dune',
        'poster' => 'images/jt8SJ26Ij1XXXHOTS7F6RHwCo9MweiDPYzvKu6Ek.jpg',
        'banner' => 'images/726ceplSjsaKuaOUe2oLbKaqYk3EgBfqZ64C02kW.jpg',
        'year' => 2021,
        'runtime' => 155,
        'plot' => 'Arrakis, también denominado "Dune", se ha convertido en el planeta más importante del universo. A su alrededor comienza una gigantesca lucha por el poder que culmina en una guerra interestelar.',
        'director' => 'Denis Villeneuve',
        'file' => 'media/voMmwBLyN5lSQmH3QidBOYtaBQb9nSb0eltrzHHm.mp4',
        'trailer' => 'trailer/DdGfoIvXIrONmOVKpNAJ4We5xKXS72LXwrEcq1NJ.mp4',
        'created_at' => '2023-04-11 11:27:53',
        'price' => 10.99
      ]);

    DB::table('movies')->insert([
        'title' => 'Ciudad Perdida',
        'poster' => 'images/T9Sj7J2JyeTxp5DjORe8cKbfDGw7mrZXTESVurDO.jpg',
        'banner' => 'images/MeLBDweNNP5z1HyaNGxt29Sgrz6K1WrgVTqcWVfU.jpg',
        'year' => 2022,
        'runtime' => 102,
        'plot' => 'La escritora solitaria Loretta Sage escribe sobre lugares exóticos en sus populares novelas de aventuras con un atractivo modelo de portada, Alan. Mientras está de gira promocionando su nuevo libro, es secuestrada por un excéntrico multimillonario.',
        'director' => 'Aaron Nee y Adam Nee',
        'file' => 'media/KSqcuXd5e4NX4MX4x1tZ7qjTWVK4ZJ4EJzdblOw0.mp4',
        'trailer' => 'trailer/B9u0QkMUfse9q8cBnQilSBCOxb9Mq2mw2OfyG6z9.mp4',
        'created_at' => '2023-04-11 11:32:55',
        'price' => 14.99
      ]);

    DB::table('movies')->insert([
        'title' => 'Free Guy',
        'poster' => 'images/mRSF1UHmOCFvUukaMwutdH5hQqkNXJoqQsJ4i73s.jpg',
        'banner' => 'images/TUhNKANnB6pJ9FJp81Yz866P8UgCtd4kIp8xcCvD.jpg',
        'year' => 2021,
        'runtime' => 115,
        'plot' => 'Un cajero de un banco descubre que en realidad es un personaje sin papel dentro de un brutal videojuego de mundo interactivo.',
        'director' => 'Shawn Levy',
        'file' => 'media/sdZDxhxTIQXhgemaOMaTzSzE7kGiLZYwiKwCI4ei.mp4',
        'trailer' => 'trailer/EJLcOh92pmbDKwNgB5Dm3MzlBms3mtLhiLVXLQQU.mp4',
        'created_at' => '2023-04-11 11:36:57',
        'price' => 10.99
      ]);

    DB::table('movies')->insert([
        'title' => 'Black Panther: Wakanda Forever',
        'poster' => 'images/ZDED5jS6hmOi1d17GhZsXnSqMTtpDjDwiBoB4MLL.jpg',
        'banner' => 'images/NBHPckDTTkwVjgtiAZDzke7TEtlCKtZMJHLAuasQ.jpg',
        'year' => 2022,
        'runtime' => 161,
        'plot' => 'Una secuela que seguirá explorando el incomparable mundo de Wakanda y todos los ricos y variados personajes presentados en la película de 2018.',
        'director' => 'Ryan Coogler',
        'file' => 'media/aBNoO5aAsVztUDrnV27uEr0acDSxTKLEWgZf7wi8.mp4',
        'trailer' => 'trailer/1zFeEdJEEo1AnJYTn2PcUjr1mepZmRCjLXfKJukJ.mp4',
        'created_at' => '2023-04-11 11:38:43',
        'price' => 14.99
      ]);

    DB::table('movies')->insert([
        'title' => 'The Batman',
        'poster' => 'images/Eye6NE3JMvjdHVm03P6NABwXWti8xZKzpxF3XiKN.jpg',
        'banner' => 'images/awYzxG77DWcEtt7Yjav7dyxUzU5LxVMVR2dow1an.jpg',
        'year' => 2022,
        'runtime' => 175,
        'plot' => 'En su segundo año luchando contra el crimen, Batman explora la corrupción existente en la ciudad de Gotham y el vínculo de esta con su propia familia. Además, entrará en conflicto con un asesino en serie conocido como "el Acertijo".',
        'director' => 'Matt Reeves',
        'file' => 'media/45vZ3hWpytw862loStrV2oIzugZ2DDVCLeXUmRcx.mp4',
        'trailer' => 'trailer/Q9dXTYG7CXHpEng2fI9cjB6s29R2A357oDil99ph.mp4',
        'created_at' => '2023-04-11 11:44:00',
        'price' => 14.99
      ]);

    DB::table('movies')->insert([
        'title' => 'Bloodshot',
        'poster' => 'images/vOu3ZjTSzx5lglGzo5P19oZljiYBoVj4H2T4QBsB.jpg',
        'banner' => 'images/Z1xlftNEYqwyYbNFI69CO0XSH7ERPVvhHsZCA053.jpg',
        'year' => 2020,
        'runtime' => 109,
        'plot' => 'Murray Ray Garrison es resucitado por un equipo de científicos. Mejorado con nanotecnología, se convierte en una máquina de matar biotecnológica sobrehumana. Cuando Ray entrena por primera vez con otros super soldados, no recuerda nada de su vida anterior. Pero cuando recuerda que lo mataron, sale de las instalaciones para vengarse, solo para descubrir que la conspiración va más allá de lo que pensaba.',
        'director' => 'David S F Wilson',
        'file' => 'media/N2dM9Tf4gdKTxBEhDiEGdjbHYzA8dnZgTuVNVQZT.mp4',
        'trailer' => 'trailer/4j7kKtCospnv5k3IobF1aHshcFxJLzDQLBO9NDTQ.mp4',
        'created_at' => '2023-04-11 11:47:24',
        'price' => 4.99
      ]);

    DB::table('movies')->insert([
        'title' => 'Ready Player One',
        'poster' => 'images/7xalSXW7PfHiiZ4p9vauiTfFz0Qzpbu3MBvK7alT.jpg',
        'banner' => 'images/UcfEQfs1DFAvMZIKGHbfjXSEGEd6RzL0diMp2sZW.jpg',
        'year' => 2018,
        'runtime' => 139,
        'plot' => 'Año 2045. El adolescente Wade Watts es solo una de las millones de personas que se evaden del sombrío mundo real para sumergirse en un mundo utópico virtual donde todo es posible: OASIS. Wade participa en la búsqueda del tesoro que el creador de este mundo imaginario dejó oculto en su obra.',
        'director' => 'Steven Spielberg',
        'file' => 'media/az6JcYqKdEk0R3lvDhmSdSrNxFIaSvfp1EobSAZ6.mp4',
        'trailer' => 'trailer/6iFPAjyeOjs4EQ82n1IaXDYSKKd97B89k0sW3F1h.mp4',
        'created_at' => '2023-04-11 11:49:28',
        'price' => 4.99
      ]);
      //
    DB::table('movies')->insert([
        'title' => 'Drama',
        'poster' => 'images/WTmUSSpY55cifJeLRD1OdXUAdC5xR4bbXK6NrmJd.jpg',
        'banner' => 'images/Lu0e9Cw5jncbjW5H7ehMzZGMmi6RXZ7PBRGYxo84.jpg',
        'year' => 2010,
        'runtime' => 80,
        'plot' => 'Tres estudiantes de teatro, influenciados por un carismático profesor y la técnica actoral creada por el francés Antonin Artaud, comienzan a experimentar con sus propias vidas en busca de emociones y situaciones reales para llevar al escenario. Su obsesión por ser mejores actores los guía a contactarse con sus lados más oscuros, sobrepasando límites que ni ellos mismos ni sus maestros imaginaron.',
        'director' => 'Matias Lira',
        'file' => 'media/GzVN898edUUdJ3pUEbIXo54h5SbMfHPm9igSDOM6.mp4',
        'trailer' => 'trailer/DLCcyIyui0xkslhJ9Mye5asIkgkkNjX8SyYLQy4N.mp4',
        'created_at' => '2023-06-01 15:02:45',
        'updated_at' => '2023-06-01 15:02:45',
        'price' => 4.99
    ]);

    DB::table('movies')->insert([
        'title' => 'Dungeons & Dragons: Honor entre ladrones',
        'poster' => 'images/rdFbkUQgUur8NkS44uUD94VtVaQv5ciHfqayEsSv.jpg',
        'banner' => 'images/cWqg53PIwj97a4vLE0BzDvVE0w4ciBhmSm20pqK6.jpg',
        'year' => 2023,
        'runtime' => 134,
        'plot' => 'Adaptación cinematográfica del primer juego de rol de la historia, publicado por primera vez en 1974. Un ladrón encantador y una banda de aventureros increíbles emprenden un atraco épico para recuperar una reliquia perdida, pero las cosas salen rematadamente mal cuando se topan con las personas equivocadas.',
        'director' => 'Jonathan M. Goldstein',
        'file' => 'media/JmkIN5KTW83dBeniKffmcuCNRBfH5n8pg1eJ5dtU.mp4',
        'trailer' => 'trailer/8w5aF1VcUfkZE8o2R8W1E3sGRlaTOp286IIE2Z5F.mp4',
        'created_at' => '2023-06-01 15:23:24',
        'updated_at' => '2023-06-06 15:26:17',
        'price' => 14.99
    ]);

    DB::table('movies')->insert([
        'title' => 'Ellas',
        'poster' => 'images/ZhWqGDpcjMEUbXRCVOPcrof6cykEQjC5K0Kh30mW.jpg',
        'banner' => 'images/baURXLMgDwrpdmqInvebLugPrk10sxIv1PWHklRW.jpg',
        'year' => 2011,
        'runtime' => 99,
        'plot' => 'Una periodista intenta equilibrar las labores del matrimonio y la maternidad mientras investiga un caso de mujeres universitarias que trabajan como prostitutas para pagar por sus estudios.',
        'director' => 'Malgorzata Szumowska',
        'file' => 'media/Pj2e3sZZdMjKdQepvw61A6u92P3goFkxSPJ3nTz7.mp4',
        'trailer' => 'trailer/qbaPD2vtauvBx5MMKM8ClT1yWKch66wxZGD5H1JG.mp4',
        'created_at' => '2023-06-06 15:26:17',
        'updated_at' => '2023-06-06 15:26:17',
        'price' => 4.99
    ]);
  }
}
