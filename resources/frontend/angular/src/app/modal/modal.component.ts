import {Component, ElementRef, Input, OnDestroy, OnInit, Output, ViewEncapsulation, EventEmitter} from '@angular/core';
import {ModalService} from '../services/modal.service';
import {SlideInOutAnimation} from '../animations/slide-in-animation';
import {FadeInAnimation} from '../animations/fade-in-animation';

@Component({
  selector: 'app-modal',
  templateUrl: './modal.component.html',
  styleUrls: ['./modal.component.scss'],
  encapsulation: ViewEncapsulation.None,
  animations: [SlideInOutAnimation, FadeInAnimation]
})
export class ModalComponent implements OnInit, OnDestroy {
  @Input() id = 0;
  @Input() dark: boolean | undefined;
  private readonly element: any;
  @Output() closeModal = new EventEmitter<boolean>();

  constructor(private modalService: ModalService,
              private el: ElementRef) {
    this.element = el.nativeElement;
  }

  ngOnInit(): void {
    if (!this.id) {
      console.error('modal must have an id');
      return;
    }
    document.body.appendChild(this.element);
    this.element.addEventListener('click', (el: any) => {
      if (typeof el.target.className === 'string' && el.target.className.includes('lv-modal ')) {
        this.close();
      }
    });
    this.modalService.add(this);
    this.modalService.modalReadyNotifyer.next(this.id);
  }

  ngOnDestroy(): void {
    this.element.style.display = 'none';
    document.body.classList.remove('lv-modal-open');
    this.element.remove();
  }

  open(): void {
    this.element.style.display = 'block';
    document.body.classList.add('lv-modal-open');
  }

  close(): void {
    this.closeModal.emit(true);
    this.modalService.remove(this.id);
  }

  onExit(): void {
    this.close();
  }
}
