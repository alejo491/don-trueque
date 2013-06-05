Prado.WebUI.TDatePicker = Class.create();
Object.extend(Prado.WebUI.TDatePicker,
{
	/**
	 * @return Date the date from drop down list options.
	 */
	getDropDownDate : function(control)
	{
		var now=new Date();
		var year=now.getFullYear();
		var month=now.getMonth();
		var day=1;
		var month_list = this.getMonthListControl(control);
	 	var day_list = this.getDayListControl(control);
	 	var year_list = this.getYearListControl(control);
		
		var day = day_list ? $F(day_list) : 1;
		var month = month_list ? $F(month_list) : now.getMonth();
		var year = year_list ? $F(year_list) : now.getFullYear();
		return new Date(year,month,day, 0, 0, 0);
	},
	
	getYearListControl : function(control)
	{
		return $(control.id+"_year");
	},
	
	getMonthListControl : function(control)
	{
		return $(control.id+"_month");
	},
	
	getDayListControl : function(control)
	{
		return $(control.id+"_day");
	}
});

Prado.WebUI.TDatePicker.prototype = 
{
	
		MonthNames : {
									'espanol':[	"Enero",		"Febrero",		"Marzo",	"Abril",			"Mayo",			"Junio",			"Julio",		"Agosto",			"Septiembre",	"Octubre",		"Noviembre",	"Diciembre"		],
									'Persian' : [	"فروردین",	"اردیبهشت",	"خرداد",		"تیر",	"مرداد",			"شهریور",			"مهر",			"آبان",		"آذر",			"دی",	"بهمن",		"اسفند"		],
									'Hijri'	: ["محرم","صفر","ربیع الاول","ربیع الثانی","جمادی الاول","جمادی الثانی","رجب","شعبان","رمضان","شوال","ذی القعده","ذی الحجه"]
									},
		AbbreviatedMonthNames :{
														'espanol' : ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
														'Persian' : [	"فروردین",	"اردیبهشت",	"خرداد",		"تیر",	"مرداد",			"شهریور",			"مهر",			"آبان",		"آذر",			"دی",	"بهمن",		"اسفند"],
														'Hijri'	: ["محرم","صفر","ربیع الاول","ربیع الثانی","جمادی الاول","جمادی الثانی","رجب","شعبان","رمضان","شوال","ذی القعده","ذی الحجه"]														
														
														},
													
		ShortWeekDayNames : {
												'gregorian' : ["Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "sab" ],
												'Persian' : ["یکشنبه", "دوشنبه", "سه شنبه", "چهار شنبه" , "پنج", "جمعه", "شنبه"],
												'Hijri'	: ["یکشنبه", "دوشنبه", "سه شنبه", "چهار شنبه" , "پنج", "جمعه", "شنبه"]
												},	

	Format : "yyyy-MM-dd",

	FirstDayOfWeek : 1, // 0 for sunday
	
	ClassName : "TDatePicker",

	FromYear : 2000, UpToYear: 2015,
	initialize : function(options)
	{
		if(options.TypeCalendar != 'espanol')
		{
			//Saturday
			options.FirstDayOfWeek = 6;
		}
		//Persian, Hijri, gregorian
		this.TypeCalendar = options.TypeCalendar;
		// this.selectedxDate for Persian and Hijri , because javascript's ObjectDate (new Date()) cann't accept [for example] 2/29
		this.selectedxDate = new Array(0,0,0);
		this.options = options || [];
		this.control = $(options.ID);	
		this.dateSlot = new Array(42);
		this.weekSlot = new Array(6);
		this.minimalDaysInFirstWeek	= 4;
		this.selectedDate = this.newDate();
		// This Block is for set default month name.
		if(this.options.InputMode != "TextBox")
		{
			var today = this.newDate();
			var day = Prado.WebUI.TDatePicker.getDayListControl(this.control);
			var month = Prado.WebUI.TDatePicker.getMonthListControl(this.control);
			var year = Prado.WebUI.TDatePicker.getYearListControl(this.control);
			if(this.TypeCalendar != 'gregorian')
			{
				_date = this.gregorian_to_x(today.getFullYear(), today.getMonth(), today.getDate());
				if(year) Prado.WebUI.TDatePicker.getYearListControl(this.control).value = _date[0];
				if(day) Prado.WebUI.TDatePicker.getDayListControl(this.control).value = _date[2];
				if(month) 
				{
					Prado.WebUI.TDatePicker.getMonthListControl(this.control).value = _date[1];			
					for(temp=0; temp < this.AbbreviatedMonthNames[options.TypeCalendar].length; ++temp)
					{
						Prado.WebUI.TDatePicker.getMonthListControl(this.control).options[temp].innerHTML = this.AbbreviatedMonthNames[options.TypeCalendar][temp];
					}
				}
			}
		}
		else
		{
			var today = this.newDate();
			if(this.TypeCalendar != 'gregorian')
			{
				_date = this.gregorian_to_x(today.getFullYear(), today.getMonth(), today.getDate());
				this.control.value = _date[0]+"-"+_date[1]+"-"+_date[2];
			}
		}
		//which element to trigger to show the calendar
		if(this.options.Trigger)
		{
			this.trigger = $(this.options.Trigger) ;
			var triggerEvent = this.options.TriggerEvent || "click";
		}
		else
		{
			this.trigger  = this.control;
			var triggerEvent = this.options.TriggerEvent || "focus";
		}
		
		Object.extend(this,options);
		
		Event.observe(this.trigger, triggerEvent, this.show.bindEvent(this));
		this.create();	
	},

	create : function()
	{
		var div;
		var table;
		var tbody;
		var tr;
		var td;
	
		// Create the top-level div element
		this._calDiv = document.createElement("div");
		this._calDiv.className = this.ClassName;
		this._calDiv.style.display = "none";		
		this._calDiv.style.position = "absolute"
		
		// header div
		div = document.createElement("div");
		div.className = "calendarHeader";
		this._calDiv.appendChild(div);
		
		table = document.createElement("table");
		table.style.cellSpacing = 0;
		div.appendChild(table);
		
		tbody = document.createElement("tbody");
		table.appendChild(tbody);
		
		tr = document.createElement("tr");
		tbody.appendChild(tr);
		
		// Previous Month Button
		td = document.createElement("td");
		var previousMonth = document.createElement("button");
		previousMonth.className = "prevMonthButton";
		previousMonth.appendChild(document.createTextNode("<<"));
		td.appendChild(previousMonth);
		tr.appendChild(td);
		
		//
		// Create the month drop down 
		//
		td = document.createElement("td");
		tr.appendChild(td);
		this._monthSelect = document.createElement("select");
		this._monthSelect.className = "months";

		for (var i = 0 ; i < this.MonthNames[this.TypeCalendar].length ; i++) {
	        var opt = document.createElement("option");
	        opt.innerHTML = this.MonthNames[this.TypeCalendar][i];
	        opt.value = i;
	        if (i == this.selectedDate.getMonth()) {
	            opt.selected = true;
	        }
	        this._monthSelect.appendChild(opt);
	    }
		td.appendChild(this._monthSelect);
		

		// 
		// Create the year drop down
		//
		td = document.createElement("td");
		td.className = "labelContainer";
		tr.appendChild(td);
		this._yearSelect = document.createElement("select");
		for(var i=this.FromYear; i <= this.UpToYear; ++i) {
			var opt = document.createElement("option");
			opt.innerHTML = i;
			opt.value = i;
			if (i == this.selectedDate.getFullYear()) {
				opt.selected = false;
			}
			this._yearSelect.appendChild(opt);
		}
		td.appendChild(this._yearSelect);
		
		
		td = document.createElement("td");
		td.className = "nextMonthButton";
		var nextMonth = document.createElement("button");
		nextMonth.appendChild(document.createTextNode(">>"));
		td.appendChild(nextMonth);
		tr.appendChild(td);
		
		// Calendar body
		div = document.createElement("div");
		div.className = "calendarBody";
		this._calDiv.appendChild(div);
		var calendarBody = div;
		
		// Create the inside of calendar body	
		
		var text;
		table = document.createElement("table");
		table.className = "grid";
	
	    div.appendChild(table);
		var thead = document.createElement("thead");
		table.appendChild(thead);
		tr = document.createElement("tr");
		thead.appendChild(tr);
		for(i=0; i < 7; ++i) {
			td = document.createElement("th");
			
			text = document.createTextNode(this.ShortWeekDayNames[this.TypeCalendar][(i+this.FirstDayOfWeek)%7]);
			td.appendChild(text);
			td.className = "weekDayHead";
			tr.appendChild(td);
		}
		
		// Date grid
		tbody = document.createElement("tbody");
		table.appendChild(tbody);
		
		for(week=0; week<6; ++week) {
			tr = document.createElement("tr");
			tbody.appendChild(tr);

		for(day=0; day<7; ++day) {
				td = document.createElement("td");
				td.className = "calendarDate";
				text = document.createTextNode(String.fromCharCode(160));
				td.appendChild(text);

				tr.appendChild(td);
				var tmp = new Object();
				tmp.tag = "DATE";
				tmp.value = -1;
				tmp.data = text;
				this.dateSlot[(week*7)+day] = tmp;
				
				Event.observe(td, "mouseover", this.hover.bindEvent(this));
				Event.observe(td, "mouseout", this.hover.bindEvent(this));
				
			}
		}
		
		// Calendar Footer
		div = document.createElement("div");
		div.className = "calendarFooter";
		this._calDiv.appendChild(div);

		var todayButton = document.createElement("button");
		todayButton.className = "todayButton";
		var today = this.newDate();
		
		if(this.TypeCalendar != 'gregorian')
		{
			_date = this.gregorian_to_x(today.getFullYear(), today.getMonth(), today.getDate());
			var buttonText = _date[0]+"-"+(_date[1]+1)+"-"+_date[2];
		}
		else
			var buttonText = today.SimpleFormat(this.Format,this);
		
		todayButton.appendChild(document.createTextNode(buttonText));
		div.appendChild(todayButton);
		
		/*var clearButton = document.createElement("button");
		clearButton.className = "clearButton";
		buttonText = "Clear";
		clearButton.appendChild(document.createTextNode(buttonText));
		div.appendChild(clearButton);
		*/

		if(Prado.Browser().ie)
		{
			this.iePopUp = document.createElement('iframe');
			this.iePopUp.src = "";
			this.iePopUp.style.position = "absolute"
			this.iePopUp.scrolling="no"
			this.iePopUp.frameBorder="0"
			document.body.appendChild(this.iePopUp);
		}

		document.body.appendChild(this._calDiv);
		
		this.update();
		this.updateHeader();
		
		this.ieHack(true);

		// IE55+ extension		
		previousMonth.hideFocus = true;
		nextMonth.hideFocus = true;
		todayButton.hideFocus = true;
		// end IE55+ extension
		
		// hook up events
		Event.observe(previousMonth, "click", this.prevMonth.bindEvent(this));
		Event.observe(nextMonth, "click", this.nextMonth.bindEvent(this));
		Event.observe(todayButton, "click", this.selectToday.bindEvent(this));
		//Event.observe(clearButton, "click", this.clearSelection.bindEvent(this));
		Event.observe(this._monthSelect, "change", this.monthSelect.bindEvent(this));
		Event.observe(this._yearSelect, "change", this.yearSelect.bindEvent(this));

		// ie6 extension
		Event.observe(this._calDiv, "mousewheel", this.mouseWheelChange.bindEvent(this));		
		
		Event.observe(calendarBody, "click", this.selectDate.bindEvent(this));
				
	},
	
	ieHack : function(cleanup) 
	{
		// IE hack
		if(this.iePopUp) 
		{
			this.iePopUp.style.display = "block";
			this.iePopUp.style.top = (this._calDiv.offsetTop -1 ) + "px";
			this.iePopUp.style.left = (this._calDiv.offsetLeft -1)+ "px";
			this.iePopUp.style.width = Math.abs(this._calDiv.offsetWidth -2)+ "px";
			this.iePopUp.style.height = (this._calDiv.offsetHeight + 1)+ "px";
			if(cleanup) this.iePopUp.style.display = "none";
		}
	},
	
	getDaysPerMonth : function (nMonth, nYear) 
		{
			if(this.TypeCalendar == 'Persian'){
				nMonth = (nMonth + 12) % 12;
				var days = [31,31,31,31,31,31,30,30,30,30,30,29];
				var res = days[nMonth];
				if (nMonth == 11) //feburary, leap years has 29
        	res += nYear % 3 == 0 ? 1 : 0;
		    return res;
			}
			else
			{
				nMonth = (nMonth + 12) % 12;
		    var days= [31,28,31,30,31,30,31,31,30,31,30,31];
				var res = days[nMonth];
				if (nMonth == 1) //feburary, leap years has 29
	                res += nYear % 4 == 0 && !(nYear % 400 == 0) ? 1 : 0;
		        return res;
			}
		}
	,
	keyPressed : function(ev)
	{
		if(!this.showing) return;
		if (!ev) ev = document.parentWindow.event;
		var kc = ev.keyCode != null ? ev.keyCode : ev.charCode;
		
		if(kc == Event.KEY_RETURN)
		{
			this.setSelectedDate(this.selectedDate);
			Event.stop(ev);
			this.hide();
		}
		if(kc == Event.KEY_ESC)
		{
			Event.stop(ev); this.hide();
		}
		
		if(kc < 37 || kc > 40) return true;

		var current = this.selectedDate;
		var d = current.valueOf();
		if(kc == Event.KEY_LEFT)
		{
			if(ev.ctrlKey || ev.shiftKey) // -1 month
			{
                current.setDate( Math.min(current.getDate(), this.getDaysPerMonth(current.getMonth() - 1,current.getFullYear())) ); // no need to catch dec -> jan for the year
                d = current.setMonth( current.getMonth() - 1 );
			}
			else
				d -= 86400000; //-1 day
		}
		else if (kc == Event.KEY_RIGHT)
		{
			if(ev.ctrlKey || ev.shiftKey) // +1 month
			{
				current.setDate( Math.min(current.getDate(), this.getDaysPerMonth(current.getMonth() + 1,current.getFullYear())) ); // no need to catch dec -> jan for the year
				d = current.setMonth( current.getMonth() + 1 );
			}
			else
				d += 86400000; //+1 day
		}
		else if (kc == Event.KEY_UP)
		{
			if(ev.ctrlKey || ev.shiftKey) //-1 year
			{
				current.setDate( Math.min(current.getDate(), this.getDaysPerMonth(current.getMonth(),current.getFullYear() - 1)) ); // no need to catch dec -> jan for the year
				d = current.setFullYear( current.getFullYear() - 1 );
			}
			else
				d -= 604800000; // -7 days
		}
		else if (kc == Event.KEY_DOWN) 
		{
			if(ev.ctrlKey || ev.shiftKey) // +1 year
			{
				current.setDate( Math.min(current.getDate(), this.getDaysPerMonth(current.getMonth(),current.getFullYear() + 1)) ); // no need to catch dec -> jan for the year
				d = current.setFullYear( current.getFullYear() + 1 );
			}
			else 
				d += 7 * 24 * 61 * 60 * 1000; // +7 days
		}
		this.setSelectedDate(d);
		Event.stop(ev);	
	},
	
	selectDate : function(ev)
	{
		var el = Event.element(ev);
		while (el.nodeType != 1)
			el = el.parentNode;
		
		while (el != null && el.tagName && el.tagName.toLowerCase() != "td")
			el = el.parentNode;
			
		// if no td found, return
		if (el == null || el.tagName == null || el.tagName.toLowerCase() != "td")
			return;

		var n = Number(el.firstChild.data);
		if (isNaN(n) || n <= 0 || n == null)
			return;
		
		if(this.TypeCalendar != 'gregorian')
		{
			_date = this.x_to_gregorian(this.selectedxDate['Year'], this.selectedxDate['Month'], n);
			this.selectedDate = new Date(_date[0], _date[1], _date[2]);
			var d = this.newDate(this.selectedDate);
		}
		else 
		{
			var d = this.newDate(this.selectedDate);
			d.setDate(n);
		}
		this.setSelectedDate(d);
		this.hide();
	},
	
	selectToday : function()
	{
		if(this.selectedDate.toISODate() == this.newDate().toISODate())
			this.hide();
		this.setSelectedDate(this.newDate());
	},
	
	clearSelection : function()
	{
		this.setSelectedDate(this.newDate());
		this.hide();
	},
	
	monthSelect : function(ev)
	{
		this.setMonth(Form.Element.getValue(Event.element(ev)));
	},
	
	yearSelect : function(ev)
	{
		this.setYear(Form.Element.getValue(Event.element(ev)));
	},
	
	// ie6 extension
	mouseWheelChange : function (e) 
	{
		if (e == null) e = document.parentWindow.event;
		var n = - e.wheelDelta / 120;
		var d = this.newDate(this.selectedDate);
		var m = d.getMonth() + n;
		this.setMonth(m);
			
		return false;
	},

	onChange : function() 
	{
		if(this.options.InputMode == "TextBox")
		{
			this.control.value = this.formatDate();
			Event.fireEvent(this.control, "change");
		}
		else
		{
			var day = Prado.WebUI.TDatePicker.getDayListControl(this.control);
			var month = Prado.WebUI.TDatePicker.getMonthListControl(this.control);
			var year = Prado.WebUI.TDatePicker.getYearListControl(this.control);
			var date = this.selectedDate;
			if(day)
			{
				if(this.TypeCalendar != 'gregorian')
					day.selectedIndex = this.selectedxDate['Day']-1;
				else
					day.selectedIndex = date.getDate()-1;
			}
			if(month)
			{
				if(this.TypeCalendar != 'gregorian')
					month.selectedIndex = this.selectedxDate['Month'];
				else
					month.selectedIndex = date.getMonth();
			}
			if(year)
			{
				var years = year.options;
				var currentYear = date.getFullYear();
				for(var i = 0; i < years.length; i++)
				{
					years[i].selected = years[i].value.toInteger() == currentYear;
				}
			}
			Event.fireEvent(day || month || year, "change");
		}
	},
	intPart : function (floatNum){	if (floatNum< -0.0000001){		 return Math.ceil(floatNum-0.0000001)		}	return Math.floor(floatNum+0.0000001)	},
	
	gregorian_to_Hijri : function (g_y,g_m,g_d){	g_m+=1; if ((g_y>1582)||((g_y==1582)&&(g_m>10))||((g_y==1582)&&(g_m==10)&&(g_d>14))) 	{		jd=this.intPart((1461*(g_y+4800+this.intPart((g_m-14)/12)))/4)+this.intPart((367*(g_m-2-12*(this.intPart((g_m-14)/12))))/12)-	this.intPart( (3* (this.intPart(  (g_y+4900+    this.intPart( (g_m-14)/12)     )/100)    )   ) /4)+g_d-32075;	}	else	{		jd = 367*g_y-this.intPart((7*(g_y+5001+this.intPart((g_m-9)/7)))/4)+this.intPart((275*g_m)/9)+g_d+1729777;	}	l=jd-1948440+10632+1;	n=this.intPart((l-1)/10631);	l=l-10631*n+354;	j=(this.intPart((10985-l)/5316))*(this.intPart((50*l)/17719))+(this.intPart(l/5670))*(this.intPart((43*l)/15238));	l=l-(this.intPart((30-j)/15))*(this.intPart((17719*j)/50))-(this.intPart(j/16))*(this.intPart((15238*j)/43))+29;	i_m=this.intPart((24*l)/709);	i_d=l-this.intPart((709*i_m)/24);	i_y=30*n+j-30;	i_m-=1; return Array(i_y,i_m,i_d)},
	Hijri_to_gregorian : function (i_y,i_m,i_d){	i_m+=1; jd=this.intPart((11*i_y+3)/30)+354*i_y+30*i_m-this.intPart((i_m-1)/2)+i_d+1948440-385-1;	if (jd> 2299160 )	{		l=jd+68569;		n=this.intPart((4*l)/146097);		l=l-this.intPart((146097*n+3)/4);		i=this.intPart((4000*(l+1))/1461001);		l=l-this.intPart((1461*i)/4)+31;		j=this.intPart((80*l)/2447);		g_d=l-this.intPart((2447*j)/80);		l=this.intPart(j/11);		g_m=j+2-12*l;		g_y=100*(n-49)+i+l;	}		else		{		j=jd+1402;		k=this.intPart((j-1)/1461);		l=j-1461*k;		n=this.intPart((l-1)/365)-this.intPart(l/1461);		i=l-365*n+30;		j=this.intPart((80*i)/2447);		g_d=i-this.intPart((2447*j)/80);		i=this.intPart(j/11);		g_m=j+2-12*i;		g_y=4*k+n+i-4716;	}	g_m-=1; return Array(g_y , g_m , g_d,jd)},
	
	gregorian_to_jalali : function(g_y, g_m, g_d){    g_days_in_month = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);     j_days_in_month = new Array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);        gy = g_y-1600;    gm = g_m;    gd = g_d-1;  g_day_no = 365*gy+Math.floor((gy+3) / 4)-Math.floor((gy+99)/100)+Math.floor((gy+399)/400);    for (i=0; i < gm; ++i) g_day_no += g_days_in_month[i];    if (gm>1 && ((gy%4==0 && gy%100!=0) || (gy%400==0)))       g_day_no++;    g_day_no += gd;    j_day_no = g_day_no-79;    j_np = Math.floor(j_day_no/ 12053);   j_day_no = j_day_no % 12053;    jy = 979+33*j_np+4*Math.floor(j_day_no/1461);   j_day_no %= 1461;    if (j_day_no >= 366) {       jy += Math.floor((j_day_no-1)/ 365);       j_day_no = (j_day_no-1)%365;    }    for (i = 0; i < 11 && j_day_no >= j_days_in_month[i]; ++i)       j_day_no -= j_days_in_month[i];    jm = i; jd = j_day_no+1; return Array(jy,jm,jd)},	
	jalali_to_gregorian : function(j_y, j_m, j_d){ if(j_m < 0) {j_y+=j_m;j_m=11;} g_days_in_month=new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);g_days_in_month_kabise =new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);     j_days_in_month =new Array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);	j_days_in_month_kabise =new Array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 30);   jy = j_y-979;    jm = j_m;    jd = j_d-1;    j_day_no = 365*jy + Math.floor(jy/ 33)*8 + Math.floor(((jy%33)+3)/ 4);    for (i=0; i < jm; ++i)       j_day_no += j_days_in_month[i];    j_day_no += jd;    g_day_no = j_day_no+79;    gy = 1600 + 400 * Math.floor(g_day_no/ 146097);   g_day_no = g_day_no % 146097;    leap = true;    if (g_day_no >= 36525)   {       g_day_no--;       gy += 100*Math.floor(g_day_no/ 36524);      g_day_no = g_day_no % 36524;       if (g_day_no >= 365)          g_day_no++;       else          leap = false;    }    gy += 4*Math.floor(g_day_no/ 1461);    g_day_no %= 1461;    if (g_day_no >= 366) {       leap = false;       g_day_no--;       gy += Math.floor(g_day_no/ 365);       g_day_no = g_day_no % 365;    }    for (i = 0; g_day_no >= g_days_in_month[i] + (i == 1 && leap); i++)       g_day_no -= g_days_in_month[i] + (i == 1 && leap);    gm = i;    gd = g_day_no+1;    return Array(gy, gm, gd);},
	gregorian_to_x : function(y, m, d){
		if(this.TypeCalendar == 'Persian')
			return this.gregorian_to_jalali(y, m, d);
		else if(this.TypeCalendar == 'Hijri')
			return this.gregorian_to_Hijri(y, m, d);
		else return new array(y, m, d);
	},
	x_to_gregorian : function(y, m, d){
		if(this.TypeCalendar == 'Persian')
			return this.jalali_to_gregorian(y, m, d);
		else if(this.TypeCalendar == 'Hijri')
			return this.Hijri_to_gregorian(y, m, d);
		else return new array(y, m, d);
	},
	
	formatDate : function()
	{
		if(this.TypeCalendar != 'gregorian')
		{
			_date = this.gregorian_to_x(this.selectedDate.getFullYear(), this.selectedDate.getMonth(), this.selectedDate.getDate());
			return _date[0]+"-"+(_date[1]+1)+"-"+_date[2];
		}
/*		if(this.TypeCalendar == 'Hijri')
		{
			jDate = this.gregorian_to_Hijri(this.selectedDate.getFullYear(), this.selectedDate.getMonth(), this.selectedDate.getDate());
			return jDate[0]+"-"+(jDate[1]+1)+"-"+jDate[2];
		}*/
		else
			return this.selectedDate ? this.selectedDate.SimpleFormat(this.Format,this) : '';
	},

	newDate : function(date)
	{
		if(!date)  date = new Date();
		if(typeof(date) == "string" || typeof(date) == "number")
			date = new Date(date);
		return new Date(date.getFullYear(), date.getMonth(), date.getDate(), 0,0,0);
	},

	setSelectedDate : function(date) 
	{
		if (date == null)
			return;
		this.selectedDate = this.newDate(date);
		this.updateHeader();
		this.update();
		if (typeof(this.onChange) == "function")
			this.onChange();
	},

	getElement : function() 
	{
		return this._calDiv;
	},

	getSelectedDate : function () 
	{
		return this.selectedDate == null ? null : this.newDate(this.selectedDate);
	},
	
	setYear : function(year) 
	{
		if(this.TypeCalendar != 'gregorian')
		{
			gDate = this.x_to_gregorian(year, this.selectedxDate['Month'], this.selectedxDate['Day']);
			this.selectedDate = new Date(gDate[0], gDate[1], gDate[2]);
			var d = this.newDate(this.selectedDate);
			this.setSelectedDate(d);
		}
		else
		{
			var d = this.newDate(this.selectedDate);
			d.setFullYear(year);
			this.setSelectedDate(d);
		}
	},

	setMonth : function (month) 
	{
		if(this.TypeCalendar != 'gregorian')
		{
			gDate = this.x_to_gregorian(this.selectedxDate['Year'], month, this.selectedxDate['Day']);
			this.selectedDate = new Date(gDate[0], gDate[1], gDate[2]);
			var d = this.newDate(this.selectedDate);
			this.setSelectedDate(d);
		}
		else
		{
			var d = this.newDate(this.selectedDate);
			d.setMonth(month);
			this.setSelectedDate(d);
		}
		
	},

	nextMonth : function () 
	{
		if(this.TypeCalendar != 'gregorian')
			this.setMonth(this.selectedxDate['Month']+1);
		else
			this.setMonth(this.selectedDate.getMonth()+1);
	},

	prevMonth : function () 
	{
		if(this.TypeCalendar != 'gregorian')
			this.setMonth(this.selectedxDate['Month']-1);
		else
			this.setMonth(this.selectedDate.getMonth()-1);
	},
	
	show : function() 
	{
		if(!this.showing)
		{
			var pos = Position.cumulativeOffset(this.control);

			if(this.options.InputMode == "TextBox")
				pos[1] += this.control.offsetHeight;
			else
			{
				var dayList = Prado.WebUI.TDatePicker.getDayListControl(this.control);
				if(dayList)
					pos[1] += dayList.offsetHeight-1;
			}

			this._calDiv.style.display = "block";
			this._calDiv.style.top = (pos[1]-1) + "px";
			this._calDiv.style.left = pos[0] + "px";
			
			this.ieHack(false);
			this.documentClickEvent = this.hideOnClick.bindEvent(this);
			this.documentKeyDownEvent = this.keyPressed.bindEvent(this);
			Event.observe(document.body, "click", this.documentClickEvent);
			
			var date = this.getDateFromInput();
			
			if(date)
			{
				if(this.TypeCalendar != 'gregorian')
				{
					gDate = this.x_to_gregorian(date.getFullYear(), date.getMonth(), date.getDate());
					date = new Date(gDate[0], gDate[1], gDate[2]);			
				}
				this.selectedDate = date;
				this.setSelectedDate(date);
			}
			Event.observe(document,"keydown", this.documentKeyDownEvent); 
			this.showing = true;
		}
	},

	getDateFromInput : function()
	{
		if(this.options.InputMode == "TextBox")
			return Date.SimpleParse($F(this.control), this.Format);
		else
			return Prado.WebUI.TDatePicker.getDropDownDate(this.control);
	},
	
	//hide the calendar when clicked outside any calendar
	hideOnClick : function(ev)
	{
		if(!this.showing) return;
		var el = Event.element(ev);
		var within = false;
		do
		{
			within = within || el.className == this.ClassName;
			within = within || el == this.trigger;
			within = within || el == this.control;
			if(within) break;
			el = el.parentNode;			
		}
		while(el);
		if(!within) this.hide();
	},
	
	hide : function()
	{
		if(this.showing)
		{
			this._calDiv.style.display = "none";
			if(this.iePopUp)
				this.iePopUp.style.display = "none";
			this.showing = false;	
			Event.stopObserving(document.body, "click", this.documentClickEvent);	
			Event.stopObserving(document,"keydown", this.documentKeyDownEvent); 
		}	
	},
	
	getD1 : function (d1){
		_xDate = this.gregorian_to_x(d1.getFullYear(), d1.getMonth(), d1.getDate());
		while(_xDate[2] > 1)
		{
				d1 = new Date(d1.getFullYear(), d1.getMonth(), d1.getDate()-1);
				_xDate = this.gregorian_to_x(d1.getFullYear(), d1.getMonth(), d1.getDate());
		}
		return d1;
	},
	
	getD2 : function (d1){
		_xDate = this.gregorian_to_x(d1.getFullYear(), d1.getMonth(), d1.getDate());
		while(_xDate[2] > 1)
		{
				d1 = new Date(d1.getFullYear(), d1.getMonth(), d1.getDate()+1);
				_xDate = this.gregorian_to_x(d1.getFullYear(), d1.getMonth(), d1.getDate());
		}
		return d1;
	},
	update : function() 
	{
		var date = this.selectedDate;
		var today = (this.newDate()).toISODate();
		var selected = date.toISODate();
		
		if(this.TypeCalendar != 'gregorian'){
			var d1 = this.getD1(new Date(date.getFullYear(), date.getMonth(), date.getDate()));
			var d2 = this.getD2(new Date(d1.getFullYear(), d1.getMonth(), d1.getDate()+27));
		}
		else
		{
			var d1 = new Date(date.getFullYear(), date.getMonth(), 1);
			var d2 = new Date(date.getFullYear(), date.getMonth()+1, 1);
		}
		var monthLength = Math.round((d2 - d1) / (24 * 60 * 60 * 1000));
		var firstIndex = (d1.getDay() - this.FirstDayOfWeek) % 7 ;
		if (firstIndex < 0)
	    	firstIndex += 7;
		var index = 0;

		
		while (index < firstIndex) {
			this.dateSlot[index].value = -1;
			this.dateSlot[index].data.data = String.fromCharCode(160);
			this.dateSlot[index].data.parentNode.className = "empty";
			index++;
		}
			for (p = 1; p <= monthLength; p++, index++) {
				var slot = this.dateSlot[index];
				var slotNode = slot.data.parentNode;
				slot.value = p;
				slot.data.data = p;
				slotNode.className = "date";
				
				if (d1.toISODate() == today) {
					slotNode.className += " today";
				}
				
				if (d1.toISODate() == selected) {
					//	slotNode.style.color = "blue";
					slotNode.className += " selected";
				}
				d1 = new Date(d1.getFullYear(), d1.getMonth(), d1.getDate()+1);
			}
		
		var lastDateIndex = index;
	        
	    while(index < 42) {
			this.dateSlot[index].value = -1;
			this.dateSlot[index].data.data = String.fromCharCode(160);
			this.dateSlot[index].data.parentNode.className = "empty";
			++index;
		}
		
	},
	
	hover : function(ev)
	{
		//conditionally add the hover class to the event target element.
		if(ev.type == "mouseover")
			Event.element(ev).addClassName("hover");
		else
			Event.element(ev).removeClassName("hover");
	},
	
	updateHeader : function () {
		if(this.TypeCalendar != 'gregorian')
		{
			jDate = this.gregorian_to_x(this.selectedDate.getFullYear(), this.selectedDate.getMonth(), this.selectedDate.getDate());
			this.selectedxDate['Year'] = jDate[0];
			this.selectedxDate['Month'] = jDate[1];
			this.selectedxDate['Day'] = jDate[2];
		}		
		var options = this._monthSelect.options;
		
		if(this.TypeCalendar != 'gregorian')
			var m = this.selectedxDate['Month'];
		else
			var m = this.selectedDate.getMonth();
		
		for(var i=0; i < options.length; ++i) {
			options[i].selected = false;
			if (options[i].value == m) {
				options[i].selected = true;
			}
		}
		
		options = this._yearSelect.options;
		
		if(this.TypeCalendar != 'gregorian')
			var year = this.selectedxDate['Year'];
		else
			var year = this.selectedDate.getFullYear();
		
		for(var i=0; i < options.length; ++i) {
			options[i].selected = false;
			if (options[i].value == year) {
				options[i].selected = true;
			}
		}
	
	}
	
	
};
