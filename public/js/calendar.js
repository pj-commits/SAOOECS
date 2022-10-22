const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

function calendar() {
  return {
    month: '',
    year: '',
    no_of_days: [],
    blankdays: [],
    days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

    form_dictionary: 
      {
        'APF': 'Activity Proposal Form',
        'BRF': 'Budget Requisition Form',
        'NR': 'Narrative Report',
        'LF': 'Liquidation Form',
      },
    events: [],
    listOfEvents: '',

    themes: [
      {
        value: "APF",
        label: "Blue Theme"
      },
      {
        value: "BRF",
        label: "Red Theme"
      },
      {
        value: "NR",
        label: "Yellow Theme"
      },
      {
        value: "LF",
        label: "Green Theme"
      },
    ],

    initDate() {
      let today = new Date();
      this.month = today.getMonth();
      this.year = today.getFullYear();
      this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
    },

    isToday(date) {
      const today = new Date();
      const d = new Date(this.year, this.month, date);

      return today.toDateString() === d.toDateString() ? true : false;
    },

    addEvent(forms) {
        forms.forEach(form => {
            this.events.push({
                id: form.id,
                organization: form.organization,
                event_title: form.event_title,
                form_type: form.form_type,
                description: this.form_dictionary[form.form_type],
                deadline: new Date(form.deadline),
                date_submitted: new Date(form.created_at)
              });
        });
    },

    viewForm(formId){ 
      let id = formId
      window.location.assign("/submitted-forms/details/"+id);
    },

    getNoOfDays() {
      let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

      // find where to start calendar day of week
      let dayOfWeek = new Date(this.year, this.month).getDay();
      let blankdaysArray = [];
      for ( var i=1; i <= dayOfWeek; i++) {
        blankdaysArray.push(i);
      }

      let daysArray = [];
      for ( var i=1; i <= daysInMonth; i++) {
        daysArray.push(i);
      }
      
      this.blankdays = blankdaysArray;
      this.no_of_days = daysArray;
    },

    getEvents(date, type){
      let events = this.events.filter(event => new Date(event.deadline).toDateString() === new Date(this.year, this.month, date).toDateString());
      if(type === "getLength"){
        return events.length;
      }else if(type === "modalEvents"){
        this.listOfEvents = events;
      }

    },

    getRandomNum(){
       return Math.ceil((Math.random() * 4));
    }
  }
}