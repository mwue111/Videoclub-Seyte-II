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
      'poster' => 'images/FRS0hqqhxjs0x9QUcl1lKeCwcpUjkkI3Xiyve03s.jpg',
      'banner' => 'images/FRS0hqqhxjs0x9QUcl1lKeCwcpUjkkI3Xiyve03s.jpg',
      'year' => 2009,
      'runtime' => 162,
      'plot' => '
            Un infante de marina parapléjico enviado a la luna Pandora en una misión única se debate entre seguir sus órdenes y proteger el mundo que siente que es su hogar.',
      'director' => 'James Cameron',
      'file' => 'media/5enaVi1JS9ALMEAo4GOtAFstehGkV6FEKTnmOekD.mp4',
      'trailer' => 'trailer/lnke6zb5wlLGB6CMUyt2L4iTVmEbifbSrJ4yx2Uj.mp4',
      'created_at' => '2023/01/30'
    ]);

    DB::table('movies')->insert([
      'title' => 'Soy leyenda',
      'poster' => 'images/VFfWG0JHOM4ruZglNFt9UlqflMgMvHGRfnDJfILM.jpg',
      'banner' => 'images/VFfWG0JHOM4ruZglNFt9UlqflMgMvHGRfnDJfILM.jpg',
      'year' => 2007,
      'runtime' => 101,
      'plot' => '
            Años después de que una plaga mate a la mayor parte de la humanidad y transforme al resto en monstruos, el único sobreviviente en la ciudad de Nueva York lucha valientemente para encontrar una cura.',
      'director' => 'Francis Lawrence',
      'file' => 'media/c6E7k557TpRvZhOKb4oLMsIts2IEwKa2Usu321lS.mp4',
      'trailer' => 'trailer/wrbhYt4HvZ3SaY7pPrNyMmWDYvSfkx3hmODOegKX.mp4',
      'created_at' => '2023/02/28'
    ]);

    DB::table('movies')->insert([
      'title' => '300',
      'poster' => 'images/6WMQnzC4bTHC45mk4oN4Foy6aZEoiAZoPFDWMDn7.jpg',
      'banner' => 'images/6WMQnzC4bTHC45mk4oN4Foy6aZEoiAZoPFDWMDn7.jpg',
      'year' => 2006,
      'runtime' => 117,
      'plot' => 'El rey Leónidas de Esparta y una fuerza de 300 hombres luchan contra los persas en las Termópilas en el 480 a.C.',
      'director' => 'Zack Snyder',
      'file' => 'media/XZBQyZoTGCksGKqHFN72DPJI5MZ0jF5TkpREPgCW.mp4',
      'trailer' => 'trailer/xnxZuFIBxZABCoBm9c6mSYjUVHHkhpYhBIQu8Tag.mp4',
      'created_at' => '2023/03/30'
    ]);

    DB::table('movies')->insert([
      'title' => 'Bullet Train',
      'poster' => 'images/lrGhDgEsrNZTt3jfbnuRvdL2AiS8XCNJT0hCSLHc.jpg',
      'banner' => 'images/2GVfeKIHODe0vdLkaCLgQcIQCefXfuYOHUr59lGk.jpg',
      'year' => 2022,
      'runtime' => 126,
      'plot' => 'Cinco asesinos a sueldo se encuentran a bordo de un tren bala que viaja de Tokio a Morioka. Los sicarios descubrirán que sus misiones no son ajenas entre sí.',
      'director' => 'David Leitch',
      'file' => 'media/IARur2nxcl2qlZMPEKO386UVDo1XZ0LQdA21mAwQ.mp4',
      'trailer' => 'trailer/1il872nGM0tHk1HZqS0Ae4xZrUK814mrJtOA3r1T.mp4',
      'created_at' => '2023-04-11 08:50:32'
    ]);

    DB::table('movies')->insert([
      'title' => 'Uncharted',
      'poster' => 'images/ZUOq9xkhbFAHc1yIakqCSYU9FtpOjncDRH1gaDUw.jpg',
      'banner' => 'images/spxBdQPxWHsP3fg0WEFhbOI4slbT7WSzLiHREEnq.jpg',
      'year' => 2022,
      'runtime' => 95,
      'plot' => 'Nathan Drake y su compañero Victor Sullivan se adentran en la peligrosa búsqueda del "mayor tesoro jamás encontrado". Al mismo tiempo, rastrean pistas que puedan conducir al hermano perdido de Drake.',
      'director' => 'Ruben Fleischer',
      'file' => 'media/QsFqjUTc064auGwvXo1t11fFpSdZZPNFYzl1doam.mp4',
      'trailer' => 'trailer/toEZNfUxRVwD2PyX3yDznUjLbMlDCaGUM8s7RN4l.mp4',
      'created_at' => '2023-04-11 09:12:53'
    ]);

    DB::table('movies')->insert([
      'title' => 'Black Adam',
      'poster' => 'images/Wueysgjg8Vwby0hhn46jQCof4sa90onbJRPjJ1T2.jpg',
      'banner' => 'images/kW3KUjLXFtzxCkBTcG7pjJul7t2UU338fsWZMjum.jpg',
      'year' => 2022,
      'runtime' => 125,
      'plot' => 'Unos arqueólogos liberan de su tumba a Black Adam, quien llevaba 5000 años preso tras haber recibido los poderes de los dioses. De nuevo entre los humanos, Black Adam se dispone a imponer su justicia, muy diferente a la del mundo en el que despertó.',
      'director' => 'Jaume Collet-Serra',
      'file' => 'media/wnHO43RsNNXlioywxzrdyiosLtjGnRwuRbzbPx7T.mp4',
      'trailer' => 'trailer/2w4GC6HFQoL1Yc4idIQa6AvFzWi22VUmt8tqWYom.mp4',
      'created_at' => '2023-04-11 09:14:56'
    ]);

    DB::table('movies')->insert([
      'title' => 'The Gray Man',
      'poster' => 'images/051n3sJc3bg05OeuxAdj9L05h2yGZRsZjvUnNUf5.jpg',
      'banner' => 'images/4eQXPBGctlOa2onX49zQM8qNM0W2NCTPKrBq9gEn.jpg',
      'year' => 2022,
      'runtime' => 122,
      'plot' => 'Cuando un misterioso agente de la CIA descubre trapos sucios de la Agencia, un excompañero desquiciado pone precio a su cabeza y lo persigue por todo el mundo.',
      'director' => 'Joe Russo y Anthony Russo',
      'file' => 'media/FLQBF9dghkIlzxN59wbxCIBEYOKfUvdfkFAUuFC0.mp4',
      'trailer' => 'trailer/1QQLBJTqMMwx05hJe3aahY4LGYmI5DYmgvXz1DxF.mp4',
      'created_at' => '2023-04-11 09:19:49'
    ]);

    DB::table('movies')->insert([
      'title' => 'Jurassic World: Dominion',
      'poster' => 'images/66wHecYswb68lGmMcWpMOIiwLFy5HlxOIWxceVkB.jpg',
      'banner' => 'images/H0EFog2DpNfcgMGdfIE3hKhZMYnbCX5E4b0o78IC.jpg',
      'year' => 2022,
      'runtime' => 86,
      'plot' => 'Cuatro años después de la destrucción de la Isla Nublar, los dinosaurios viven y cazan junto a los humanos en todo el mundo. Este frágil equilibrio remodelará el futuro y determinará si los humanos seguirán siendo o no la especie dominante.',
      'director' => 'Colin Trevorrow',
      'file' => 'media/g5ixw6MsIN0CWLsOgF6CY36Ch909TWNrkOHZcGV5.mp4',
      'trailer' => 'trailer/2sNqLshl41iVh8SWcem5JF4Im3HKg7is2dzWxyFU.mp4',
      'created_at' => '2023-04-11 09:27:59'
    ]);

    DB::table('movies')->insert([
      'title' => 'El hombre del norte',
      'poster' => 'images/jHKiGILBZsGmrqknJMtbU5SS3kALdpn9t93UTjQd.jpg',
      'banner' => 'images/Vmg6Rn3yLhkfAkLKKwvvs9RXerKyfEGQPn22mVQM.jpg',
      'year' => 2022,
      'runtime' => 120,
      'plot' => 'El príncipe Amleth está a punto de convertirse en hombre pero, en ese momento, su tío asesina brutalmente a su padre y secuestra a la madre del niño. Dos décadas después, Amleth es un vikingo que tiene la misión de salvar a su madre.',
      'director' => 'Robert Eggers',
      'file' => 'media/10sDu6Jg7mD6v9brQmM9NhJsLeOnvehbGL1ePZWZ.mp4',
      'trailer' => 'trailer/LE1QDgzWB3ctxLGRi7Jdthj5xwYEJZ9cnMnSdX9I.mp4',
      'created_at' => '2023-04-11 09:31:01'
    ]);

    DB::table('movies')->insert([
        'title' => 'Spider-Man: No Way Home',
        'poster' => 'images/zPa4nACTFkoIOMDOLjwguBnyK8Gqy8jEnqsjVnUE.jpg',
        'banner' => 'images/vuJp6DoGkF1oF5JlgMMGd67G0o0Pn2yIQVGGbrAQ.jpg',
        'year' => 2021,
        'runtime' => 148,
        'plot' => 'Esta versión extendida cuenta con más de 11 minutos contenido extra, incluyendo escenas eliminadas.Por primera vez en la historia cinematográfica de Spider-Man, nuestro héroe, vecino y amigo es desenmascarado y por tanto ya no es capaz de separar su vida normal de los enormes riesgos que conlleva ser un Súper Héroe. Cuando pide ayuda a Doctor Strange, los riesgos pasan a ser aún más peligrosos, obligándole a descubrir lo que realmente significa ser Spider-Man.',
        'director' => 'Jon Watts',
        'file' => 'media/XDJDLnmJv1i7bIRWFJvDyM4hnw8m33zKhOVJDq7w.mp4',
        'trailer' => 'trailer/eOKiuFuFAHArdqxRhSx1B8BRMZlyYhw6D3ZLFUcp.mp4',
        'created_at' => '2023-04-11 09:33:54'
      ]);

    DB::table('movies')->insert([
        'title' => 'Top Gun: Maverick',
        'poster' => 'images/coQd8bdSe3kCgSSPDTKE71aRsv0Ptw8RpyoPYK2E.jpg',
        'banner' => 'images/9DltG6mGmMAK9iiRLtG0xQtgj1dzcFFzVRkFPiNh.jpg',
        'year' => 2022,
        'runtime' => 130,
        'plot' => 'Tras más de 30 años de servicio como uno de los mejores aviadores de la Armada, Pete "Maverick" Mitchel se encuentra donde siempre quiso estar, empujando los límites como un valiente piloto de pruebas.',
        'director' => 'Joseph Kosinski',
        'file' => 'media/7ZbSnWOfPB70KwUN4ZXOqtTHzFu7NdZ9q6LCbEMp.mp4',
        'trailer' => 'trailer/gVVyJSqLSOmBOoHvvxPGdmQhyKjiSsxRsJMJVm9A.mp4',
        'created_at' => '2023-04-11 09:36:31'
      ]);

    DB::table('movies')->insert([
        'title' => 'Morbius',
        'poster' => 'images/kbYDnfQC5s2ZFqHi4t9y2Xb3zRFmk3ZGtRz4H6Fa.jpg',
        'banner' => 'images/MZCjU5LfhpuE5fALr9axdJaAjTppjaZjiPL6eRWj.jpg',
        'year' => 2022,
        'runtime' => 104,
        'plot' => 'Ambientada en el universo de Spider Man, se centra en uno de sus villanos más icónicos, Morbius, un doctor que tras sufrir una enfermedad en la sangre y fallar al intentar curarse, se convirtió en un vampiro.',
        'director' => 'Daniel Espinosa',
        'file' => 'media/lR0kZUkRXstVfAZroKMjrnoKfSH1vBsWDjGQnI20.mp4',
        'trailer' => 'trailer/wxy8L6vhmAFdAa0Fs2z7H4EhXpgy5Qt2NKeqcvcl.mp4',
        'created_at' => '2023-04-11 09:37:51'
      ]);

    DB::table('movies')->insert([
        'title' => 'Infinite Storm',
        'poster' => 'images/DCRa5zXFnrn3ovhRpnL2prhd9pfuJTrL1gXMzGxm.jpg',
        'banner' => 'images/VID4MqyKiaPQojNStRskAFGSY6PrcHTKp7RFsKM3.jpg',
        'year' => 2022,
        'runtime' => 97,
        'plot' => 'Una alpinista empieza el descenso antes de alcanzar la cumbre porque se avecina una tormenta de nieve. En el camino, encuentra a un hombre en peligro de muerte y, juntos, tratan de llegar vivos al pie de la montaña en unas condiciones infernales.',
        'director' => 'Malgorzata Szumowska y Michal Englert',
        'file' => 'media/MzxSpGmSc2d68QEOxMBbBSlQkNMwhKM7a6RBHtao.mp4',
        'trailer' => 'trailer/NKER1VvkJciRZBw65Oe7vK6pCVoFt57q9ub6Uv4v.mp4',
        'created_at' => '2023-04-11 11:16:13'
      ]);

    DB::table('movies')->insert([
        'title' => 'Beast',
        'poster' => 'images/VDeDLzRRQDTZngXezX9ofGI4nXvV1XyLYkmLe7wy.jpg',
        'banner' => 'images/CZp9Kg2vSLSGE8hUqL04ENjOG9QZR3IuYG7q1sUe.jpg',
        'year' => 2022,
        'runtime' => 93,
        'plot' => 'Un hombre que acaba de enviudar y sus dos hijas adolescentes viajan a una reserva de caza en Sudáfrica. Sin embargo, su viaje de curación pronto se convierte en una lucha por la supervivencia cuando un león sediento de sangre comienza a acecharlos.',
        'director' => 'Baltasar Kormákur',
        'file' => 'media/2FGuPtrn5jQSqppmeoa8urXx6DVRo31ReE0b6gWy.mp4',
        'trailer' => 'trailer/C7rddptOfCTkMqopu5w0mo8w23c22SdILhEY4jy0.mp4',
        'created_at' => '2023-04-11 11:19:58'
      ]);

    DB::table('movies')->insert([
        'title' => 'Animales Fantásticos',
        'poster' => 'images/8p3dVKxCyNKQTkqwBMfsFC61pPu533HSSNDC0LwH.jpg',
        'banner' => 'images/rvziYO6oOddfr6bosGYjibBwoIruMYSP7HMF7387.jpg',
        'year' => 2022,
        'runtime' => 120,
        'plot' => 'La historia tiene lugar en Río de Janeiro, Brasil y conduce a la participación del Mundo Mágico en la Segunda Guerra Mundial.',
        'director' => 'David Yates',
        'file' => 'media/UX7lJ0MKaV4zaMdPgwAW2GKWXDdDvIQAgPYId3oZ.mp4',
        'trailer' => 'trailer/qveJozEKI6ZJl6Cx5vfO9iH3fK2UcoRPVt35NAiM.mp4',
        'created_at' => '2023-04-11 11:22:54'
      ]);

    DB::table('movies')->insert([
        'title' => 'Dune',
        'poster' => 'images/7zXBlsea9PYTUbsPbPOEoKYuSck986Ygrk9jV7bz.jpg',
        'banner' => 'images/ah82az0hlIvEPj49aT87S0ms3K7BMtwkmpwcj6R9.jpg',
        'year' => 2021,
        'runtime' => 155,
        'plot' => 'Arrakis, también denominado "Dune", se ha convertido en el planeta más importante del universo. A su alrededor comienza una gigantesca lucha por el poder que culmina en una guerra interestelar.',
        'director' => 'Denis Villeneuve',
        'file' => 'media/CYxRc5erfEoH1HtqlcUqg9LQhmasY4QmQxjCPIkv.mp4',
        'trailer' => 'trailer/cegjKrNtSRDSwk0wJVY1ClYdeZAYShnmFJ870n2l.mp4',
        'created_at' => '2023-04-11 11:27:53'
      ]);

    DB::table('movies')->insert([
        'title' => 'Ciudad Perdida',
        'poster' => 'images/5nByRSv5WXENKEduflWkojVD6fWbfUXL1lXilu3H.jpg',
        'banner' => 'images/vQltxfLWwSymlQe0ElEFM4T5yfZYRImWPD0eaCj7.jpg',
        'year' => 2022,
        'runtime' => 102,
        'plot' => 'La escritora solitaria Loretta Sage escribe sobre lugares exóticos en sus populares novelas de aventuras con un atractivo modelo de portada, Alan. Mientras está de gira promocionando su nuevo libro, es secuestrada por un excéntrico multimillonario.',
        'director' => 'Aaron Nee y Adam Nee',
        'file' => 'media/KDbJtxAv6SpjB5KzNXIBPIUcJxUCi7ZX6rebcyv6.mp4',
        'trailer' => 'trailer/WtEYIbvcrnBLOgxJmdcbVeCnUQZh0AuRZUh6AJxz.mp4',
        'created_at' => '2023-04-11 11:32:55'
      ]);

    DB::table('movies')->insert([
        'title' => 'Free Guy',
        'poster' => 'images/C0DEEu0DZFvuSlCxrb5Vjkl8bHt3MwZ13dG5khOY.jpg',
        'banner' => 'images/DpvpeowoW6Opk46wul2dv314MfLeDziyTkMT2Iha.jpg',
        'year' => 2021,
        'runtime' => 115,
        'plot' => 'Un cajero de un banco descubre que en realidad es un personaje sin papel dentro de un brutal videojuego de mundo interactivo.',
        'director' => 'Shawn Levy',
        'file' => 'media/tO0w7zN1LZkSdJduBqcbX9e7DDdIVfL8DwhoUvWD.mp4',
        'trailer' => 'trailer/jHvmd8TQEfcti4IZHeh6r5FjN04WIxPwDSc9yBmH.mp4',
        'created_at' => '2023-04-11 11:36:57'
      ]);

    DB::table('movies')->insert([
        'title' => 'Black Panther: Wakanda Forever',
        'poster' => 'images/4lbtP6wSm8ELcJm89tW6JERizlshCymFy7oDhM9z.jpg',
        'banner' => 'images/HCFLPbgX8FCrXL7P5IPh3voV3ZKpovJqoFDB7z4u.jpg',
        'year' => 2022,
        'runtime' => 161,
        'plot' => 'Una secuela que seguirá explorando el incomparable mundo de Wakanda y todos los ricos y variados personajes presentados en la película de 2018.',
        'director' => 'Ryan Coogler',
        'file' => 'media/yoOdMVgZZXKUH3ihOnBnVt6DZKG1smxo1o8KV6M9.mp4',
        'trailer' => 'trailer/IquOX2GIlSptQdhphff31v6Mp273JKApAO3YGX4M.mp4',
        'created_at' => '2023-04-11 11:38:43'
      ]);

    DB::table('movies')->insert([
        'title' => 'The Batman',
        'poster' => 'images/lnNnPyKEb4QokeWIzfhD333GBq8MwYbgdtqtrX7X.jpg',
        'banner' => 'images/7cwDk6NMHe8MlMby8wN0HxD7ShgKNWZaSgF0Ew5T.jpg',
        'year' => 2022,
        'runtime' => 175,
        'plot' => 'En su segundo año luchando contra el crimen, Batman explora la corrupción existente en la ciudad de Gotham y el vínculo de esta con su propia familia. Además, entrará en conflicto con un asesino en serie conocido como "el Acertijo".',
        'director' => 'Matt Reeves',
        'file' => 'media/UzYpWvAFsBE41EnrblQ18HlL8NRYGAWR82FZ155T.mp4',
        'trailer' => 'trailer/mCV9PD4ixXgE8r1DwiMz5CzxWMu5TacGRKIzqs2h.mp4',
        'created_at' => '2023-04-11 11:44:00'
      ]);

    DB::table('movies')->insert([
        'title' => 'Bloodshot',
        'poster' => 'images/BUXO3Z1DIKez7b4hX2beqUBa0SmZiBtehwTDAv8d.jpg',
        'banner' => 'images/DKwqzN5Ri2giD9w3s3nOBHB4LC13OlF96JNoJLtU.jpg',
        'year' => 2020,
        'runtime' => 109,
        'plot' => 'Murray Ray Garrison es resucitado por un equipo de científicos. Mejorado con nanotecnología, se convierte en una máquina de matar biotecnológica sobrehumana. Cuando Ray entrena por primera vez con otros super soldados, no recuerda nada de su vida anterior. Pero cuando recuerda que lo mataron, sale de las instalaciones para vengarse, solo para descubrir que la conspiración va más allá de lo que pensaba.',
        'director' => 'David S F Wilson',
        'file' => 'media/IHrIbKHXUvvdMbKTPD0sPCRQZWdjzogpvRfkw4Xt.mp4',
        'trailer' => 'trailer/QGK9qhzHRvRzp5WjaF7813JqLZTo0UI52YM7uTkb.mp4',
        'created_at' => '2023-04-11 11:47:24'
      ]);

    DB::table('movies')->insert([
        'title' => 'Ready Player One',
        'poster' => 'images/7yDIP7yFZb2eQdTm8NUjPf3eknhL2cjS3flOsyyJ.jpg',
        'banner' => 'images/XhtuBrRq1LwnzhmzAbkhpVEqMYK0J3uy3t8SfiRW.jpg',
        'year' => 2018,
        'runtime' => 139,
        'plot' => 'Año 2045. El adolescente Wade Watts es solo una de las millones de personas que se evaden del sombrío mundo real para sumergirse en un mundo utópico virtual donde todo es posible: OASIS. Wade participa en la búsqueda del tesoro que el creador de este mundo imaginario dejó oculto en su obra.',
        'director' => 'Steven Spielberg',
        'file' => 'media/EdVfMXxJzxCBtB8rVywKvcWCI7pJGV2XObLU2xBn.mp4',
        'trailer' => 'trailer/VdNmSrsQ6x4KgrvbwG3Q2gLyVWFi1qEc12jcfD3r.mp4',
        'created_at' => '2023-04-11 11:49:28'
      ]);


  }
}
