import {Injectable} from '@angular/core';
import {Subject} from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ModalService {
  private modals: any[] = [];

  constructor() {
  }

  add(modal: any): void {
    this.modals.push(modal);
  }

  remove(id: number): void {
    this.modals = this.modals.filter(x => x.id !== id);
  }

  open(id: number, text: string): Subject<string> {
    const modal = this.modals.find(x => x.id === id);
    return modal.open(text);
  }

  close(id: number): void {
    const modal = this.modals.find(x => x.id === id);
    modal.close();
  }
}
