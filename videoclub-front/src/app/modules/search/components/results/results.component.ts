import { Component, SimpleChange, SimpleChanges } from '@angular/core';
import { ActivatedRoute, Route, Router } from '@angular/router';
import { SearchService } from '../../_services/search.service';
import { SearchSharedServiceService } from 'src/app/services/search-shared-service.service';
import { GenresService } from 'src/app/services/genres.service';
import { Subscription, forkJoin, switchMap } from 'rxjs';

@Component({
  selector: 'app-results',
  templateUrl: './results.component.html',
  styleUrls: ['./results.component.css']
})
export class ResultsComponent {
  query: any;
  movies: any = [];
  genres: any = [];
  directions: any = [];

  allGenres: any = [];
  suggestedGenres: any = [];
  genresNames: any = [];

  emptyQuery: boolean = false;
  requests: any = [];
  accion: any = [];
  adventure: any = [];
  comedy: any = [];
  drama: any = [];


  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private _search : SearchService,
    private _shared: SearchSharedServiceService,
    private _genres: GenresService,
  ) {
    this.query = (this.route.snapshot.queryParamMap.get('search'))?.toLocaleLowerCase();
  }

  genreSuggestion(){
    for(let i = 0; i < this.allGenres.length; i++){
      if(this.allGenres[i].toLowerCase().includes(this.query)){
        this.suggestedGenres.push(this.allGenres[i]);
      }
    }
  }

  ngOnInit(): void {
    this._genres.getAllGenres().pipe(
      switchMap((res: any) => {                 //switchMap para secuenciar observables
        for(let i = 0; i < res.length; i++) {   //Primero almacenar los nombres de los géneros en allGenres
          this.allGenres.push(res[i].name)
        }

        this.genreSuggestion();                 //Segundo comprobar si el input puede ser algún género

        for(let i = 0; i < res.length; i++){    //Tercero almacenar en requests las películas de cada género que hay en BD
          this.requests.push(this._genres.getMoviesGenre(100, res[i].id))
        }

        return forkJoin(this.requests);         //Cuarto devolver requests sólo cuando se hayan completado todos los observables
      })
    ).subscribe((moviesGenres: any) => {
      this.accion = moviesGenres[0];
      this.adventure = moviesGenres[1];
      this.comedy = moviesGenres[2];
      this.drama = moviesGenres[3];

      if(this.query === ''){
        this.emptyQuery = true;
      }
      else{
        this.addSuggestedMovies();
      }
    })

    this._shared.searchValue(this.query);       //Dar a query$ un valor

    this._search.search(this.query)
    .subscribe((res: any) => {
      this.genres = [];
      this.movies = [];

      Object.values(res).map((item: any) => {
        if(this.checkString(item)){
          this.movies.push(item);
        }
        else if(this.checkDirection(item)){
          this.directions.push(item);
        }
      })
    })
  }

  checkString(item: any){
    return item.title.toString().toLowerCase().includes(this.query) ||
          // item.director.toString().toLocaleLowerCase().includes(this.query) ||
          item.year.toString().toLocaleLowerCase().includes(this.query);
  }

  checkDirection(item: any) {
    return item.director.toString().toLocaleLowerCase().includes(this.query);
  }

  addSuggestedMovies() {
    const accion = this.accion;
    const aventura = this.adventure;
    const comedia = this.comedy;
    const drama = this.drama;

    if(Object.keys({accion})[0].includes(this.query)){
      // this.genresNames.push(Object.keys({accion})[0]);
      this.genresNames.push('acción');
      for(let i = 0; i < this.accion.length; i++){
        this.genres.push(this.accion[i]);
      }
    }
    if(Object.keys({aventura})[0].includes(this.query)){
      this.genresNames.push(Object.keys({aventura})[0]);
      for(let i = 0; i < this.adventure.length; i++){
        this.genres.push(this.adventure[i]);
      }
    }
    if(Object.keys({comedia})[0].includes(this.query)){
      this.genresNames.push(Object.keys({comedia})[0]);
      for(let i = 0; i < this.comedy.length; i++){
        this.genres.push(this.comedy[i]);
      }
    }
    if(Object.keys({drama})[0].includes(this.query)){
      this.genresNames.push(Object.keys({drama})[0]);
      for(let i = 0; i < this.drama.length; i++) {
        this.genres.push(this.drama[i]);
      }
    }
  }
}
