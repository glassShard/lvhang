import { URL } from './config';

export const ModalHiddenEventListener = (el, fn) => {
  const opts = {
      attributeFilter: ['style']
  },
  mo = new MutationObserver(mutations => {
      for (let mutation of mutations) {
          if (mutation.type === 'attributes' 
          && mutation.attributeName ==='style' 
          && mutation.target.getAttribute('style') === 'display: none;') {
              mo.disconnect();
              fn();
          }
      }
  });
  mo.observe(el, opts);
};

export function openCloseSearch() {
  const searchOpener = document.querySelector('.search-opener');
  
  searchOpener.addEventListener('click', () => {
    const search = new Search;

    const el = document.querySelector('#searchModal');
    const onHide = () => {  
      for (const [key, value] of Object.entries(search)) {
        delete search[key];
      }
    }
    
    ModalHiddenEventListener(el, onHide);
  });
}

export class Search {
  
  constructor() {
    this.searchField = document.querySelector('#search');
    this.searchField.focus();
    this.text = '';
    this.time = Date.now();
    this.timer = false;
    this.slot = 1000;
    this.URL = URL;
    this.div = document.querySelector('#results');
    
    this.searchField.addEventListener('input', (event) => {
      this.sendQuery();
    })
  }
  
  sendQuery() {
    if (this.setValue()) {
      this.deleteResults();
      const param = this.text.replace(/ +/g, ' ').replace(' ', '_');
      fetch(this.URL + '/api/v1/search/' + param).then(response => response.json()).then(data => {
        
        this.prepareHtmlFragment('page', data.foot);
        this.prepareHtmlFragment('news', data.news);
        this.prepareHtmlFragment('records', data.records);
        this.prepareHtmlFragment('galleries', data.galleries);
  
      });
    }
  }

  deleteResults() {
    this.div.innerHTML = '';
  }
  
  setValue() {
    const newTime = Date.now();
    if (this.searchField.value.length > 2) {
      if (newTime - this.time <= this.slot) {
        
        if (!this.timer) {
          this.timer = true;
          
          setTimeout(() => {
            this.sendQuery();
            this.timer = false;
          }, this.slot);
        }
                
        return false;
      }
      this.text = this.searchField.value; 
      this.time = newTime;
      console.log(this.text);
      return true;
    } else {
      this.deleteResults();
    }
  }

  removeListeners() {
    const newSearchField = this.searchField.cloneNode(true);
    this.searchField.parentNode.replaceChild(newSearchField, this.searchField);
  }

  prepareHtmlFragment(propertyName, propertyValue) {
    if (propertyValue.length) {         
      const links = propertyValue.map(value => {
        const aTag = document.createElement('a');
        aTag.classList = 'mb-2';

        if (propertyName === 'page') {
          
          aTag.href = `${this.URL}/${value}`;
          aTag.innerHTML = `${value === 'live' ? 'Élő' : 'Studio'}`;
        
        } else {
          
          aTag.href = `${this.URL}/${propertyName}/${value.id}`;
          
          if (propertyName === 'galleries' || propertyName === 'news') {
            aTag.innerHTML = `${value.title}`;
          }

          if (propertyName === 'records') {
            aTag.innerHTML = `${value.performer} - ${value.title}`;
          }
        }

        return aTag;
      });

      const title = document.createElement('h3');
      
      if (propertyName === 'page') {
        title.innerHTML = '<h3>Oldalak:</h3>';
      }

      if (propertyName === 'records') {
        title.innerHTML = '<h3>Kiadványok:</h3>';
      }

      if (propertyName === 'galleries') {
        title.innerHTML = '<h3>Képgalériák:</h3>';
      }

      if (propertyName === 'news') {
        title.innerHTML = '<h3>Hírek:</h3>';
      }

      const list = document.createElement('ul');
      links.forEach(link => {
        const li = document.createElement('li'); 
        list.appendChild(li);
        li.appendChild(link);
      });

      const hr = document.createElement('hr');
      
      this.div.append(title);
      this.div.append(list);
      this.div.append(hr);
    }
  }
}