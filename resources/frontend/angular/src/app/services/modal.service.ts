import {Injectable} from '@angular/core';
import {Subject} from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ModalService {
  private modals: any[] = [];
  quillNotifyer = new Subject<{open: boolean, id: number, text: string | null | undefined}>();
  modalReadyNotifyer = new Subject<number>();
  quillResult = new Subject<string>();

  constructor() {
  }

  add(modal: any): void {
    this.modals.push(modal);
  }

  remove(id: number): void {
    if (id >= -1) {
      this.quillNotifyer.next({open: false, id, text: null});
    }
    this.modals = this.modals.filter(x => x.id !== id);
  }

  open(id: number): Subject<string> {
    const modal = this.modals.find(x => x.id === id);
    return modal.open();
  }

  close(id: number): void {
    const modal = this.modals.find(x => x.id === id);
    modal.close();
  }
}
