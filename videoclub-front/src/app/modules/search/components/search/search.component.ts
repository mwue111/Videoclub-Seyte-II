import { Component } from '@angular/core';
import { SearchService } from '../../_services/search.service';
import { FormControl } from '@angular/forms';
import { debounceTime, distinctUntilChanged, map, tap, filter } from 'rxjs';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.css']
})
export class SearchComponent {
  inputSearch = new FormControl('');
  submitted: any;

  constructor(
    private _search: SearchService,
  ) {
    // this._search.search('avatar')
    //     .subscribe((res: any) => {
    //       console.log('res: ', res);
    //     })
  }

  ngOnInit(): void {
    this.onChange();
  }

  onChange(): void {
    this.inputSearch.valueChanges.pipe(
      // map((response: any) => {
      //   response.trim()
      // }),
      debounceTime(350),                      //espera 350ms para enviar la petición
      distinctUntilChanged(),                 //verifica que el valor a emitir no es igual al ya emitido
      filter((search:any) => search !== ''),  //se asegura que no llegue un string vacío
      tap((res: any) => {
        this.onSearch(res);
      })
    ).subscribe();
  }

  // Aquí: https://www.youtube.com/watch?v=cPKbI4d0ruU

  onSearch(search: any): void {
    console.log('search: ', search);
    this._search.search(search)
        .subscribe((res: any) => {
          console.log('resultado de la búsqueda: ', res)
          this.submitted = res; //por si quiero la búsqueda en la clase
          console.log('submitted: ', this.submitted)
        })
  }

}
