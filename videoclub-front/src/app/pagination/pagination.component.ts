import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-pagination',
  templateUrl: './pagination.component.html',
  styleUrls: ['./pagination.component.css']
})
export class PaginationComponent implements OnInit {
  @Input() data!: any;
  @Output() changePage: EventEmitter<any | null> = new EventEmitter<any | null>();

  currentPage!: number;
  totalPages!: number;
  //array con las páginas para mostrar el número en los <li>

  constructor() {}

  ngOnInit(): void {
    // console.log('data: ', this.data);
    this.currentPage = this.data.current_page;
    this.totalPages = this.data.last_page;
    console.log('página actual en paginador: ', this.currentPage);
  }

  onPageChange(page: any): void {
    this.changePage.emit(page);
  }

  goToPage(page: number){
    //sumar la página actual con el número de página que ponga en el link
    console.log(`Ir a la página ${page}`)
  }
}
