import { Component, SimpleChange, SimpleChanges } from '@angular/core';
import { ActivatedRoute, Route, Router } from '@angular/router';
import { SearchService } from '../../_services/search.service';
import { SearchSharedServiceService } from 'src/app/services/search-shared-service.service';
import { GenresService } from 'src/app/services/genres.service';
import { Subscription } from 'rxjs';

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

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private _search : SearchService,
    private _shared: SearchSharedServiceService,
    private _genres: GenresService,
  ) {
    this.query = (this.route.snapshot.queryParamMap.get('search'))?.toLocaleLowerCase();

    this._genres.getAllGenres().subscribe((res: any) => {
      for(let i = 0; i < res.length; i++){
        this.allGenres.push(res[i].name)
      }

      this.genreSuggestion();
    })
  }

  ngOnChanges(changes: SimpleChanges) {
    console.log('Cambios: ', changes);
  }

  genreSuggestion(){
    for(let i = 0; i < this.allGenres.length; i++){
      if(this.allGenres[i].toLowerCase().includes(this.query)){
        this.suggestedGenres.push(this.allGenres[i]);
      }
    }
  }

  ngOnInit(): void {
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
