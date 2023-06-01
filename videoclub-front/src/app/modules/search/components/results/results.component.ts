import { Component } from '@angular/core';
import { ActivatedRoute, Route, Router } from '@angular/router';
import { SearchService } from '../../_services/search.service';

@Component({
  selector: 'app-results',
  templateUrl: './results.component.html',
  styleUrls: ['./results.component.css']
})
export class ResultsComponent {
  query: any;
  movies: any = [];
  genres: any = [];

  constructor(
    private route: ActivatedRoute,
    private _search : SearchService,
  ) {
    this.query = this.route.snapshot.queryParamMap.get('search');
    console.log('query: ', this.query);
  }
  ngOnInit(): void {

    //Aquí: identificar si el objeto tiene el término de búsqueda. Si no lo tiene, se asume que es el género.
    this._search.search(this.query)
        .subscribe((res: any) => {
          console.log('res: ', res);
          // if(res.includes(this.query)){
            for(let i = 0; i < res.length; i++){
              this.movies.push(res[i]);
            }
          // }
          // else{
            for(let i = 0; i < res.length; i++) {
              this.genres.push(res[i]);
            }
          // }
        })
        // console.log('resultado de la búsqueda fuera de la suscripción: ', this.results)
  }
}
