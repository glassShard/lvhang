import {Pipe, PipeTransform} from '@angular/core';

@Pipe({name: 'ft' })
export class FtPipe implements PipeTransform {
  transform(price: number | undefined): string {
    if (!price) {
      return '';
    }
    const strArr = price.toString().split('');
    const ln = strArr.length;
    return strArr.reverse().reduce((acc: Array<string>, curr: string, index: number) => {
      acc.push(curr);
      if ((index + 1) % 3 === 0 && index + 1 < ln) {
        acc.push('.');
      }
      return acc;
    }, []).reverse().join('');
  }
}
