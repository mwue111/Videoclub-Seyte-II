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

  allGenres: any = [];
  suggestedGenres: any = [];

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
    // this._genres.getAllGenres().subscribe((res: any) => {
    //   for(let i = 0; i < res.length; i++){
    //     this.allGenres.push(res[i].name)
    //   }

    //   this.genreSuggestion();
    // })

    this._genres.getAllGenres().pipe(
      switchMap((res: any) => {
        for(let i = 0; i < res.length; i++) {
          this.allGenres.push(res[i].name)
        }

        this.genreSuggestion();

        const requests = [];
        for(let i = 0; i < res.length; i++){
          // requests.push(this._genres.getMoviesGenre(100, res[i].id))
          this.requests.push(this._genres.getMoviesGenre(100, res[i].id))
        }

        return forkJoin(this.requests);
      })
    ).subscribe((moviesGenres: any) => {
      if(this.query === ''){
        console.log('query vacío');
        console.log('género de las películas: ', moviesGenres);
        this.emptyQuery = true;
        this.accion = moviesGenres[0];
        this.adventure = moviesGenres[1];
        this.comedy = moviesGenres[2];
        this.drama = moviesGenres[3];
      }
    })

    //Dar a query$ un valor
    this._shared.searchValue(this.query);

    this._search.search(this.query)
    .subscribe((res: any) => {
      this.genres = [];
      this.movies = [];

      Object.values(res).map((item: any) => {
        if(this.checkString(item)){
          this.movies.push(item);
        }
        else{
          this.genres.push(item);
        }
      })
    })
  }

  checkString(item: any){
    return item.title.toString().toLowerCase().includes(this.query) ||
          item.director.toString().toLocaleLowerCase().includes(this.query) ||
          item.year.toString().toLocaleLowerCase().includes(this.query);
  }
}
