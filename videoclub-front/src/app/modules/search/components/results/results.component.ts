import { Component } from '@angular/core';
import { ActivatedRoute, Route, Router } from '@angular/router';
import { SearchService } from '../../_services/search.service';
import { GenresService } from 'src/app/services/genres.service';

@Component({
  selector: 'app-results',
  templateUrl: './results.component.html',
  styleUrls: ['./results.component.css']
})
export class ResultsComponent {
  query: any;
  results: any = [];
  genres: any = [];

  constructor(
    private route: ActivatedRoute,
    private _search : SearchService,
    private _genres: GenresService,
  ) {
    this.query = this.route.snapshot.queryParamMap.get('search');
    console.log('query: ', this.query);

    //Para comprobar si el término es un género (se queda corto y es costoso)
    this.getGenres();
  }
  ngOnInit(): void {

    this._search.search(this.query)
        .subscribe((res: any) => {
          for(let i = 0; i < res.length; i++){
            this.results.push(res[i]);
          }
        })
        // console.log('resultado de la búsqueda fuera de la suscripción: ', this.results)
  }

  getGenres() {
    this._genres.getAllGenres()
    .subscribe((res: any) => {
      for(let i = 0; i < res.length; i++){
        this.genres.push((res[i].name).toLowerCase());
      }
      if(this.genres.includes((this.query).toLowerCase())){
        this.searchGenres();
      }
    })
  }

  searchGenres() {
    console.log('Buscando películas de ese género... ');
  }
}
