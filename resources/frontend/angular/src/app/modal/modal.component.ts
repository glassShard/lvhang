import {Component, ElementRef, Input, OnDestroy, OnInit, ViewEncapsulation} from '@angular/core';
import {ModalService} from '../modal.service';
import {animate, state, style, transition, trigger} from '@angular/animations';
import {interval, Subject} from 'rxjs';

@Component({
  selector: 'app-modal',
  templateUrl: './modal.component.html',
  styleUrls: ['./modal.component.scss'],
  encapsulation: ViewEncapsulation.None,
  animations: [
    trigger('fadein', [
      state('off', style({
        opacity: 0
      })),
      state('on', style({
        opacity: 1
      })),
      transition('off => on', [
        animate('0.3s')
      ]),
      transition('on => off', [
        animate('0.3s')
      ]),
    ]),
    trigger('instantiate', [
      state('void', style({
        transform: 'translateY(-100px)',
        opacity: 0
      })),
      state('exist', style({
        transform: 'translateY(0px)',
        opacity: 1
      })),
      transition('void => exist', [
        animate('0.3s')
      ]),
      transition('exist => void', [
        animate('0.3s')
      ]),
    ])
  ]
})
export class ModalComponent implements OnInit, OnDestroy {
  @Input() id = 0;
  private readonly element: any;
  overlay = false;
  answer: any;
  editorCreated = false;
  editor: any;
  editorValue = '';

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
  }

  ngOnDestroy(): void {
    this.modalService.remove(this.id);
    this.element.remove();
  }

  open(text: string): Subject<string> {
    this.overlay = true;
    this.answer = new Subject<string>();
    this.element.style.display = 'block';
    const subscription = interval(50).subscribe(() => {
      if (this.editorCreated) {
        subscription.unsubscribe();
        this.editor.formatText(0, 10, 'color', '#abc123');
        this.editor.focus();
        this.editorValue = text;
        document.body.classList.add('lv-modal-open');
      }
    });

    return this.answer;
  }

  close(): void {
    this.element.style.display = 'none';
    this.overlay = false;
    document.body.classList.remove('lv-modal-open');
    this.answer.next(this.editorValue);
    this.editorCreated = false;
    this.editorValue = '';
  }

  created(event: any): void {
    this.editorCreated = true;
    this.editor = event;
  }
}
