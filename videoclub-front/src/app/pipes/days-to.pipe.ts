import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'daysTo'
})
export class DaysToPipe implements PipeTransform {

  transform(value: any): number {
    const _MS_PER_DAY = 1000 * 60 * 60 * 24;
    let expDate = new Date(value);
    let today = new Date();

    const utc1 = Date.UTC(expDate.getFullYear(), expDate.getMonth(), expDate.getDate());

    const utc2 = Date.UTC(today.getFullYear(), today.getMonth(), today.getDate());

    const diff = Math.floor((utc1 - utc2) / _MS_PER_DAY);

    return diff;
  }

}
