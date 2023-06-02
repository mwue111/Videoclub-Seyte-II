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
    // this.query = (this.route.snapshot.queryParamMap.get('search'))?.toLocaleLowerCase();
    this.route.queryParamMap.subscribe(params => {
      this.query = params.get('search')?.toLowerCase();
    });
  }
  ngOnInit(): void {

    this._search.search(this.query)
    .subscribe((res: any) => {
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
