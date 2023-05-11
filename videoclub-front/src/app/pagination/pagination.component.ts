import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-pagination',
  templateUrl: './pagination.component.html',
  styleUrls: ['./pagination.component.css']
})
export class PaginationComponent implements OnInit {
  @Input() currentPage!: number;
  @Input() totalPages!: number;

  // Aquí: https://levelup.gitconnected.com/implementing-pagination-with-apis-in-angular-a-step-by-step-guide-2a7bc40499d5
  constructor() {}

  ngOnInit(): void {
    console.log('número total de páginas: ', this.totalPages);
    console.log('página actual: ', this.currentPage);
  }

  onPageChange(page: number): void {
    console.log(`Page changed to ${page}`);
  }
}
