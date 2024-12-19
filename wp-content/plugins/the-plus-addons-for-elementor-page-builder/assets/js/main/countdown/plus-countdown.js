( function( $ ) {
	"use strict";
	var WidgetCountDownHandler = function ($scope, $) {
        class tpcounter{

            constructor() {
                this.container = $scope[0].querySelectorAll('.tp-countdown');
                this.tp_load_counterdown();
            }

            tp_load_counterdown(){
                let GetBasic = (this.container[0] && this.container[0].dataset && this.container[0].dataset.basic) ? JSON.parse(this.container[0].dataset.basic) : '',                    
                    style = GetBasic.style;
                    this.Basic = GetBasic;
                    this.GetClassList = (this.container[0] && this.container[0].dataset && this.container[0].dataset.classlist) ? JSON.parse(this.container[0].dataset.classlist) : '';

                    if(GetBasic && GetBasic.type == "normal"){
                        if(style && style == 'style-1') {
                            this.tp_normal_style1();
                        }else if(style && style == 'style-2') {
                            this.tp_filpdown_style2();
                        }else if(style && style == 'style-3') {
                            this.tp_progressbar_style3();
                        }
                    }
            }

            tp_normal_style1(){
                $(".pt_plus_countdown").each(function () {
					var attrthis =$(this);
					var timer1 = attrthis.attr("data-timer");
					var offset_timer = attrthis.attr("data-offset");
					var text_days=attrthis.data("days");
					var text_hours=attrthis.data("hours");
					var text_minutes=attrthis.data("minutes");
					var text_seconds=attrthis.data("seconds");

					attrthis.downCount({
						date: timer1,
						offset: offset_timer,
						text_day:text_days,
						text_hour:text_hours,
						text_minute:text_minutes,
						text_second:text_seconds,
					});
				});
            }

            tp_filpdown_style2(){
                let $this = this;
                    this.FlipdownID = `tp-flipdown-${this.Basic.widgetid}`;
                    this.Basic.normalexpiry = "none";

                    if( this.container[0].classList.contains('countdown-style-2') ){
                            this.container[0].insertAdjacentHTML("afterbegin", `<div id ="${this.FlipdownID}" class="tp-scarcity-flipdown flipdown"></div>`);

                            let CounterDate = new Date(this.Basic.timer).getTime() /1000,
                                ThemeCr = 'dark';

                                new FlipDown(CounterDate, this.FlipdownID, {
                                    theme: ThemeCr,
                                    headings: [
                                        $this.Basic.days, 
                                        $this.Basic.hours, 
                                        $this.Basic.minutes, 
                                        $this.Basic.seconds
                                    ],
                                })
                                .start()
                                .ifEnded(() => {
                                    if($this.GetClassList){
                                        document.querySelector($this.GetClassList.duringcountdownclass).style.display = 'none';
                                        document.querySelector($this.GetClassList.afterexpcountdownclass).style.display = 'block';
                                    }
                                });

                                if($this.GetClassList){
                                    document.querySelector($this.GetClassList.duringcountdownclass).style.display = 'block';
                                    document.querySelector($this.GetClassList.afterexpcountdownclass).style.display = 'none';
                                }

                            this.tp_enable_column();
                            return;
                    }
            }

            tp_progressbar_style3(){
                let $this = this;
                this.Basic.normalexpiry =  "none";
                    this.tp_progressbar_sethtml();

                    let elements = this.container[0].querySelector(`#tp-sec-widget-${this.Basic.widgetid}`),
                        elementm = this.container[0].querySelector(`#tp-min-widget-${this.Basic.widgetid}`),
                        elementh = this.container[0].querySelector(`#tp-hour-widget-${this.Basic.widgetid}`),
                        elementd = this.container[0].querySelector(`#tp-day-widget-${this.Basic.widgetid}`),
                        param = this.tp_style3_styleobj();

                        if(elements){

                            let CounterDate = new Date(this.Basic.timer).getTime(),
                                seconds = new ProgressBar.Circle(elements, param),
                                minutes = new ProgressBar.Circle(elementm, param),
                                hours = new ProgressBar.Circle(elementh, param),
                                days = new ProgressBar.Circle(elementd, param);

                            var countInterval = setInterval(function() {
                                let now = new Date(),
                                    countTo = new Date(CounterDate),
                                    difference = (countTo - now);

                                let day = Math.floor(difference / (60 * 60 * 1000 * 24) * 1);
									if (day <= 0) {
										day = 0;
									}
                                    days.animate(day / (day + 5), function() {
                                        $this.tp_progressbar_settext(days, day, $this.Basic.days);
                                    });

                                let hour = Math.floor((difference % (60 * 60 * 1000 * 24)) / (60 * 60 * 1000) * 1);
									if (hour <= 0) {
										hour = 0;
									}
                                    hours.animate(hour / 24, function() {
                                        $this.tp_progressbar_settext(hours, hour, $this.Basic.hours);
                                    });

                                let minute = Math.floor(((difference % (60 * 60 * 1000 * 24)) % (60 * 60 * 1000)) / (60 * 1000) * 1);
									if (minute <= 0) {
										minute = 0;
									}
                                    minutes.animate(minute / 60, function() {
                                        $this.tp_progressbar_settext(minutes, minute, $this.Basic.minutes);
                                    });

                                let second = Math.floor((((difference % (60 * 60 * 1000 * 24)) % (60 * 60 * 1000)) % (60 * 1000)) / 1000 * 1);
									if (second <= 0) {
										second = 0;
									}
                                    seconds.animate(second / 60, function() {
                                        $this.tp_progressbar_settext(seconds, second, $this.Basic.seconds);
                                    });

                                    if(day + hour + minute + second <= 0) {
                                        clearInterval(countInterval);                                       
                                    }
                            });                           
                        }
                        this.tp_enable_column();
            }

            tp_progressbar_sethtml(){
                if(this.Basic && this.Basic.widgetid){
                    let $HTML = `<div class="tp-countdown-counter"><div class="counter-part" id="tp-day-widget-${this.Basic.widgetid}"></div><div class="counter-part" id="tp-hour-widget-${this.Basic.widgetid}"></div><div class="counter-part" id="tp-min-widget-${this.Basic.widgetid}"></div><div class="counter-part" id="tp-sec-widget-${this.Basic.widgetid}"></div></div>`;

                    this.container[0].insertAdjacentHTML("afterbegin", $HTML);
                }
            }

            tp_progressbar_settext(content, Number, Data){
                content.setText(`<span class="number">${Number}</span><span class="label">${Data}</span>`);
            }

            tp_style3_styleobj(){
                return { duration: 200, color: "#000000", trailColor: "#ddd", strokeWidth: 5, trailWidth: 3 }
            }

            tp_enable_column(){
                if( this.Basic.style == 'style-2' ){
                    let GetRotorGroup = this.container[0].querySelectorAll('.rotor-group');
                    
                    if( !this.Basic.daysenable ){
                        GetRotorGroup[0].remove();
                    } 

                    if( !this.Basic.hoursenable ){
                        GetRotorGroup[1].remove();
                    }

                    if( !this.Basic.minutesenable ){
                        GetRotorGroup[2].remove();
                    }

                    if( !this.Basic.secondsenable ){
                        GetRotorGroup[3].remove();
                    }

                    GetRotorGroup = this.container[0].querySelectorAll('.rotor-group');

                    if( !this.Basic.daysenable || !this.Basic.hoursenable || !this.Basic.minutesenable || !this.Basic.secondsenable ){
                        let getElem = GetRotorGroup[GetRotorGroup.length - 1]
                            getElem.style.setProperty('--setDisplay','none')
                    }

                }else if( this.Basic.style == 'style-3' ){
                    let GetRotorGroup = this.container[0].querySelectorAll('.counter-part');
                    if( !this.Basic.daysenable ){
                        GetRotorGroup[0].remove();
                    }

                    if( !this.Basic.hoursenable ){
                        GetRotorGroup[1].remove();
                    }

                    if( !this.Basic.minutesenable ){
                        GetRotorGroup[2].remove();
                    }

                    if( !this.Basic.secondsenable ){
                        GetRotorGroup[3].remove();
                    }
                }
            }

        }

        new tpcounter();
	};

    window.addEventListener('elementor/frontend/init', (event) => {
        elementorFrontend.hooks.addAction('frontend/element_ready/tp-countdown.default', WidgetCountDownHandler);	
    });
})(jQuery);