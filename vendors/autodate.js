/** got from http://www.merlyn.demon.co.uk/js-date4.htm , thanks! */

// sets Globals
{ 
// sets the language to english... we won't really need German but I'm gonna
// leave it in anyway, just in case we eventually decide to go international
 	Lx = 0 
  	Months = new Array(' JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC', ' JAN FEB MAR APR MAI JUN JUL AUG SEP OKT NOV DEZ')
	Suf = new Array('(st|nd|rd|th)', '(te|ste)')
  	Ln = new Array('English', 'German') 
}

function checkinputdate(input) 
{ 
	if (input != '')
	{
		var D = DatVal(input)
		//input.value = D[0] ? D[1].ISOlocaldateStr() + ' : ' + D[1] : 'Invalid'
		if (D[0])
		{
			input = D[1].MonthDayYear();
		}
		else
		{
			alert("Invalid date ");
			return false;
		}
	}
	return true;
}


function autodate(input) 
{ 
	if (input.value != '')
	{
		var D = DatVal(input.value)
		//input.value = D[0] ? D[1].ISOlocaldateStr() + ' : ' + D[1] : 'Invalid'
		if (D[0])
		{
			input.value = D[1].MonthDayYear();
		}
		else
		{
			alert("Invalid date format, please use: mm/dd/yyyy");
			input.value = '';
		}
	}
}

  
function DatVal(Q) 
{ 
	var Mon, x, Rex, B, Y, ND=0
  	Q = Q.trim() // optional line

	Rex = new RegExp(Suf[Lx], 'i') // Remove suffix, see * below
  	Q = Q.replace(Rex, ' ')  // optional paragraph

	// Seek Roman (month) : viii IX
  	Rex = /([^A-Z]+)([IVX]{1,4})(.*)/i 
  	if (Rex.test(Q)) 
  	{
  	// 1-4 Chars of month
    	Mon = Q.replace(Rex, '$2').toUpperCase() 
    	x = ' I    II   III  IV   V    VI   VII  VIII IX   X    XI   XII '.indexOf(' '+Mon)
    	Q = Q.replace(Rex, '$1 '+(1+x/5)+' $3') // make numeric
   } // optional paragraph

  	Rex = /([^A-Z]*)([A-Z]{1,3})(.*)/i
  	// Seek month letters : Au / Aug. Or {3}.
  	if (Rex.test(Q)) 
  	{
    	Mon = Q.replace(Rex, '$2').toUpperCase() // 1-3 Letters of month
    	x = Months[Lx].indexOf(' '+Mon) // or next for English only, *
    	// x = ' JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC'.
    	//   indexOf(' '+Mon)
    	Q = Q.replace(Rex, '$1 '+(1+x/4)+' $3').trim() // to numeric
    } // optional paragraph

  	Rex = /^(\d+)\D+(\d+)\D+(\d+)$/ // three digit fields
  	Q = Q.replace(Rex, '$3 $1 $2') // NA
  	B = Rex.test(Q) // Split into $1 $2 $3
  	if (B) with (RegExp) 
  	{ 
  		Y = +$1
    	if (Y<100) Y += (Y<31?2000:1900)      // optional century line
    	with (ND = new Date(Y, $2-1, $3))
      	B = ((getMonth()==$2-1) && (getDate()==$3))  
	} // YMD valid ?
  	// For true years 00..99, enter as >2 digits, check $1.length;
  	// then increase year by 100 and decrease month by 1200.
  	return [B, ND] // [Valid, DateObject]
  	// To ban leading zeros in M, D, and Y,
  	// alter all \\d+ in last Rex to [1-9]\\d?  untested.
  
} /* end DatVal */


/****************** END BAP CHANGES **********************/
/*   this is all the dude 								 */
/*   http://www.merlyn.demon.co.uk/include1.js			 */
/*   http://www.merlyn.demon.co.uk/include3.js			 */


function VSF() { document.writeln( // After Michael Donn
  '<a href="view-source:'+this.location+'">View Source File<\/a>') }


// DynWrite(target, text) (Jim Ley) works on controls, after page load :
// it is a computed function :

// Classify browser :

function GetDocVars() { // set 4 Globals; called in include1.js
  nCheck = 0
  if (DocDom = (document.getElementById?true:false))
                                           nCheck++ // NS6 also IE5
  if (DocLay = (document.layers?true:false))
                                           nCheck++ // NS4
  if (DocAll = (document.all?true:false))
                                           nCheck++ // IE4
  }  GetDocVars() // call *here*

// if (nCheck!=1) alert('Browser classification problem!  nCheck = ' +
//  String(nCheck) + '\nPlease let me know how the page works and what' +
//  ' the\nbrowser is; and, if possible, what needs to be done about it.')
function ReportDocVars() {
  if (nCheck==0)
    document.write(' None of DocDom, DocLay, DocAll is set;',
      ' Dynamic Write will fail.'.italics(), '<p>')
  if (DocDom) document.write(' DocDom is set. ')
  if (DocLay) document.write(' DocLay is set. ')
  if (DocAll) document.write(' DocAll is set. ') }

function TableDocVars() {
  document.writeln('<br><br><table summary="Browser class info"',
    ' bgcolor=blue align=center cellpadding=10 border=4>',
    '<tr><th bgcolor=wheat>For the displaying computer :</th>',
    '</tr><tr><td bgcolor=gainsboro align=center>',
    'Your browser gives<br>',
    '<b>DocAll = ', DocAll, ' ; DocDom = ', DocDom,
    ' ; DocLay = ', DocLay, '.</b><br>',
    'Check : ', nCheck, ' browser classification(s) set.',
    '</td></tr></table>') }


// Define Function DynWrite(Where, What) to suit browser :
DocStr=''
if (DocLay) DocStr="return document.layers['NS_'+id]"
if (DocAll) DocStr="return document.all[id]"
if (DocDom) DocStr="return document.getElementById(id)"
GetRef=new Function("id", DocStr)

// DocLay = true ; DocAll = DocDom = false // Simulate NS4.7
DynWarn = 0

if (DocStr=='') { DynWrite=new Function("return false") } else {
  if (DocAll || DocDom) {
    DynWrite=new Function("id", "S", "GetRef(id).innerHTML=S; return true")
    }
// if (DocLay) DynWrite=new Function("id", "S", "var x=GetRef(id).document;"+
//  "x.open('text/html'); x.write(S); x.close(); return true")
if (DocLay) DynWrite=new Function(
    "if (0==DynWarn++)"+
    " alert('DynWrite not supported in \".layers\" browsers');"+
    "return false")
 }


function NoDynLay() {
  if (DocLay) document.writeln(
    '<p><i>Dynamic Writing in a ".layers" browser such as yours ',
    'is difficult and I cannot now test it.  Therefore, ',
    'I don\'t now attempt it. An alert will be given in the ',
    'first use in each load/reload of a page.<\/i>') }

// DynWrite() end.



// General Utilities :

function LS(x) { return String(x).replace(/\b(\d)\b/g, '0$1') }

function LZ(x) { return (x<0||x>=10?"":"0") + x }

function LZZ(x) { return x<0||x>=100?""+x:"0"+LZ(x) }

function lz(x) { var t = String(x)
  return t.length==1 ? "0"+t : t } // slower?


if (String.prototype && !String.prototype.substr) {
  String.prototype.substr =
    new Function("J", "K", "return this.substring(J, J+K)") }

function TrimS() { // Grant Wagner = String.prototype.trim
  return (this.toString() ?
    this.toString().replace(/\s+$|^\s*/g, "") : "") }
String.prototype.trim = TrimS

function Sign(y) {return(y>0?'+':y<0?'-':' ')}

function Prfx(Q, L, c) { var s = Q+"" // ??
  // if (!c) var c = ' '
  if (c.length>0) while (s.length<L) { s = c+s } ;
  return s }

function StrU(X, M, N) { // X>=0.0 ; gives M digits point N digits
  var T, S=new String(Math.round(X*Number("1e"+N))) // *10^N
  if (/\D/.test(S)) { return ''+X } // cannot cope
  with (new String(Prfx(S, M+N, '0')))
    return substring(0, T=(length-N)) + '.' + substring(T) }

function StrT(X, M, N) { return Prfx(StrU(X, 1, N), M+N+2, ' ') }

function StrS(X, M, N) { return Sign(X)+StrU(Math.abs(X), M, N) }

function StrW(X, M, N) { return Prfx(StrS(X, 1, N), M+N+2, ' ') }

if (!Number.toFixed) { // 20030313
  Number.prototype.toFixed = // JL
    new Function('n',
      '  /* toFixed */ if (!n) n=0\n  return StrS(this, 1, n)') }


function SigFigNo(X, N) {
  var p = Math.pow(10, N-Math.ceil(Math.log(Math.abs(X))/Math.LN10))
  return isFinite(p) ? Math.round(X*p)/p : X }


function SigFigExp(X, N) { // N<22
  if (X==0) return SigFigExp(1, N).replace(/\+1/, ' 0')
  var p = Math.floor(Math.log(Math.abs(X))/Math.LN10)
  if (!isFinite(p)) return X
  return (X>0?'+':"") + String(
    Math.round(X*Math.pow(10, N-p-1))).replace(/(\d)/, "$1.") +
    (p>=0?"e+":"e-") + lz(Math.abs(p)) } // All OK?


function Div(a, b) { return Math.floor(a/b) }

function Mod(a, b) { return a-Math.floor(a/b)*b }


var IxIt=0, BoxX=68


function Depict(X, Y, S, Hue) { // String S is shown and returned
  if (!Hue) Hue = "black"
  var AutoID = "Auto" + ++IxIt
  document.writeln("<form name=", AutoID, ">",
    "<table align=center bordercolor=", Hue, " border=2><tr><td>",
    "<textarea name=N cols=", X, " rows=", Y, " readonly>",
    "<\/textarea><\/td><\/tr><\/table><\/form>")
  document.forms[AutoID].elements["N"].value = S
  return S }


function ShowFF() { // Args are functions, last Arg is box height
  var Len = --arguments.length, S = ""
  for (var j=0 ; j<Len ; j++) {
    if (j>0) S += "\n\n"
    S += arguments[j].toString() } // ???  but replace < > &  ???
  Depict(BoxX, arguments[Len], S, "lightgreen") ; return "" }


function ShowDo(Fn, Ht) { // N.B. this calls  Fn()
  Depict(BoxX, Ht, Fn.toString(), "red" ) ; Fn() ; return "" }


function eIVSF() {
  Depict(47, 1, "  For the code, view the source of this page.") }


var BID = 0

function PopCode(btn) {
  var Wndw = window.open("", "X"+new Date().getTime(), // /scr-bar?
    "height=" + (16*btn.btnargs[1]+40) + ",width=" + (8*BoxX+40) +
    ",resizable")
  Wndw.document.write(
    '<textarea rows=', btn.btnargs[1], ' cols=', BoxX, '>')
  for (var J=0 ; J < btn.btnargs[0].length ; J++) {
    if (J!=0) Wndw.document.write('\n\n')
    Wndw.document.write(btn.btnargs[0][J].toString()) }
  Wndw.document.write('<\/textarea>')
  Wndw.document.close() /* DU */ ; return "" }

function Btn() { var I = 'JJ' + BID++ // var BID = 0 precedes these
  document.write("<form name=", I, ">",
    "<input type=button name=N value='Pop Up Code'",
    " onClick='PopCode(this)'><\/form>")
  document.close() // DU
  document.forms[I].elements["N"].btnargs = arguments ; return "" }


function FuncName(Fn) { // Fn is a function; return its name
  return Fn.toString().match(/( \w+)/)[0] }

// Gregorian Date/Time Utilities :


// Date.prototype.getTimezoneOffset = new Function("with (this) return 0 ")


if (String.prototype && !String.prototype.substr) {
  String.prototype.substr =
    new Function("J", "K", "return this.substring(J, J+K)") }


function DoWstr(DoWk) { // JS & ISO
  return "SunMonTueWedThuFriSatSun".substr(3*DoWk, 3) }

var Mon3 =
  ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']


Date.prototype.ISOlocaltimeStr =
  new Function("  /* Date.ISOlocaltimeStr */ with (this)\n    return " +
    "LZ(getHours())+':'+LZ(getMinutes())+':'+LZ(getSeconds())")


Date.prototype.USlocaltimeStr =
  new Function("  /* Date.USlocaltimeStr */ var H\n" +
    "  with (this) return " +
    "LZ(  1+((H=getHours())+11)%12  )+':'+\n      LZ(getMinutes())+':'+ " +
    "LZ(getSeconds())+[' AM',' PM'][+(H>11)]")


Date.prototype.ISOlocaldateStr =
  new Function("  /* Date.ISOlocaldateStr */ with (this)\n    return " +
    "getFullYear()+'-'+LZ(getMonth()+1)+'-'+LZ(getDate())")

/*** BAP: this is mine **/
Date.prototype.MonthDayYear =
  new Function("  /* Date.MonthDayYear */ with (this)\n    return " +
    "LZ(getMonth()+1)+'/'+LZ(getDate())+'/'+getFullYear()")


Date.prototype.ISOlocalDTstr =
  new Function("  /* Date.ISOlocalDTstr */  with (this)\n    return " +
    "ISOlocaldateStr()+' '+ISOlocaltimeStr()")


Date.prototype.UTCstr =
  new Function("  /* Date.UTCstr */ with (this)\n    return " +
    "getUTCFullYear() + '-' + LZ(getUTCMonth()+1) + '-' +\n" +
    "      LZ(getUTCDate()) + ' ' + LZ(getUTCHours()) + ':' +\n" +
    "      LZ(getUTCMinutes()) + ':' + LZ(getUTCSeconds()) ")


Date.prototype.UTCDstr =
  new Function("  /* Date.UTCDstr */ with (this)\n    return " +
    "DoWstr(getUTCDay())+', '+UTCstr()")


Date.prototype.YMDDstr =
  new Function("  /* Date.YMDDstr */ with (this)\n    return " +
    "ISOlocaldateStr() + ' ' + DoWstr(getDay())")


Date.prototype.TZstr = // SIGN SHOULD BE RIGHT
  new Function("  /* Date.TZstr */\n" +
    "  var X, Y, Z ;\n" +
    "  with (this) {\n" +
    "    X = getTimezoneOffset() ; Y = Math.abs(X) ;\n" +
    "    Z = Y % 60 ; Y = (Y-Z)/60 ;\n" +
    "    return (X>0?'-':'+') + LZ(Y) + ':' + LZ(Z) }")



function ValidDate(y, m, d) { // m = 0..11 ; y m d integers, y!=0
  with (new Date(y, m, d))
    return (getMonth()==m && getDate()==d) /* was y, m */ }


function ReadISO8601date(Q) { var T // adaptable for other layouts
  if ((T = /^(\d+)([-\/])(\d\d)(\2)(\d\d)$/.exec(Q)) == null)
    { return -2 } // bad format
  for (var j=1; j<=5; j+=2) T[j] = +T[j] // some use needs numbers
  if (!ValidDate(T[1], T[3]-1, T[5])) { return -1 } // bad value
  return [ T[1], T[3], T[5] ] }



// MJD 40587 = 1970-01-01 GMT = Javascript day 0.
// CMJD 40587 = 1970-01-01 local.


function CMJDtoDob(CMJD) { // local time; CMJD 0 = 1858-11-17 local
  return new Date(1858, 10, 17 + CMJD) }  // ???


function YMDto8601(A) { var S = "-"
  return A[0] + S + LZ(A[1]) + S + LZ(A[2]) }


function YMDtoCMJD(y, m, d) { // m = 1..12
  return 40587 + (Date.UTC(y, m-1, d)/864e5) }


function YMDzuCMJD(y, m, d) { // Fast.  y += 7e8, result -= ...
  if (m<3) { m += 12 ; y-- } // Initial m *must* be in 1..12
  return -678973 + d + (((153*m-2)/5)|0) + // 153 = 13 + 5*28
    (1461*y>>2) - ((y/100)|0) + ((y/400)|0) }


function CMJDtoYMD(CMJD) {
  with (new Date((CMJD-40587)*864e5)) {
    return [getUTCFullYear(), getUTCMonth()+1, getUTCDate()] } }


function CMJDzuYMD(CMJD) {
  var Y=0, M=0, t, d = CMJD + 678881 // 0000-03-01
  t = (( (4*(d+36525))/146097 )|0) - 1 // Gregorian Added Rules
  Y += 100*t ; d -= 36524*t + (t>>2)
  t = (( (4*(d+366))/1461 )|0) - 1 // Julian Rules
  Y += t ; d -= 365*t + (t>>2)
  M = ( (5*d+2)/153 )|0 // 153=5*28+13 months from March, M = 0...
  d -= ((2+M*153)/5)|0 // remove full months, d = 0...
  if (M > 9) { M -= 12 ; Y++ }
  return [Y, M+3, ++d] }



// function CMJDtoISOdow(CMJD) { return ((CMJD-40587+77777773)%7)+1 } // ISO

// function WkNoDtoCMJD(Y, N, D) {
//   var Jan4 = YMDtoCMJD(Y, 1, 4)
//   var DoWk = (Jan4+777772)%7
//   return Jan4 - DoWk + 7*(N-1) + (D-1) }

// function JDNtoCMJD(YYYY, DDD) {
//   return YMDtoCMJD(YYYY, 1, 1) + (DDD-1) }

// function LastSun(y, m, ult) {
//   return ult - (YMDtoCMJD(y, m, ult)+77777773)%7 }

// end of CMJD use


function YMD2YWD(y, m, d) { // ISO WkNo. m = 1..12     i3.js
  var ms1d = 864e5, ms7d = 7*ms1d
  var D3 = Date.UTC(y, m-1, d+3)
  var wk = Math.floor(D3/ms7d)
  var yy = new Date(wk*ms7d).getUTCFullYear()
  return [yy, 1 + wk - Math.floor(Date.UTC(yy, 0, 7)/ms7d),
    ((D3/ms1d)+7777777)%7+1] }


function CMJDtoYWD(CMJD) { // cf. Calendar FAQ 2.7, Stefan Potthast
  var d4, L, d1, WeekNumber, Bodge, DoW // Bodge, DoW added by JRS
  CJD = CMJD + 2400001 ; DoW = CJD % 7
  d4 = (CJD+31741 - DoW) % 146097 % 36524 % 1461 // 0..1460
  L = +(d4==1460) // was L = (d4/1460)|0
  d1 = ((d4-L) % 365) + L
  WeekNumber = ((d1/7)|0) + 1
    Bodge = CJD - 7*(WeekNumber-26) // mid-year
    Bodge = ((Bodge/365.2425)|0) - 4712
  return [Bodge, WeekNumber, 1+DoW] }



function YWDtoCMJD(YWD) 
{ 
	var CJD, y; // By JRS 2005-02-23+
  y = YWD[0]-1; // for CJD of Jan 4, modified from YMDzuCMJD
  CJD = 1721429 + (1461*y>>2) - ((y/100)|0) + ((y/400)|0);
  CJD -= CJD%7; // Round down to Monday; CJD 0 is Monday.
  CJD += YWD[1]*7 + +YWD[2] - 8; // Contributions of W and D
  return CJD - 2400001; 
}



function Easter(Yr) { // Gregorian
  // after E G Richards, Algorithm P - upper limit ~ AD 112000?
  var AA = Math.floor(Yr / 100)
  var BB = AA - Math.floor(AA / 4)
  var CC = Yr % 19
  var DD = (15 + 19*CC + BB -
    Math.floor((AA + 1 - Math.floor((AA+8) / 25)) / 3)) % 30
  var EE = DD - Math.floor((CC+11*DD) / 319)
  var S = 22 + EE +
    (140004 - (Yr + Math.floor(Yr / 4))%7 + BB - EE) % 7
  var EMo = 3 + Math.floor(S / 32)
  var EDy = 1 + (S-1) % 31
  return [EMo, EDy] 
}



function DaysInMonth(Y, M) { // M=1..12
  with (new Date(Y, M, 1, 12)) {
    setDate(0) ; return getDate() /* OK in NS4? */ } }


function leapyear(y)
  { return (new Date(y, 1, 29)).getMonth() == 1 } // F X Mahoney


function Suffix(j) { return "thstndrd".
  substr("01230000000000000000012300000001".
    charAt(j)*2,2) }


function TimeChangeDates(YYYY) { // Detect OS settings
  var Ton, Tof, JanOff, JulOff, TonMin, TonMax, TofMin, TofMax, K
  with(new Date(YYYY, 00, 01)) {
    TonMin = TofMin = getTime() ; JanOff = getTimezoneOffset()
    setMonth(06) ; JulOff = getTimezoneOffset()
    if (JanOff == JulOff) { return [0,0] }
    setMonth(12) ; TonMax = TofMax = getTime()
    var Min = Math.min(JanOff, JulOff),
        Max = Math.max(JanOff, JulOff)
    Ton = Tof = (TonMin + TofMax)/2
    for (K=0; K<22; K++) {
      setTime(Ton) ; if (getTimezoneOffset() != Max)
        { TonMax = Ton ; Ton = (TonMin+Ton)/2 }
        else
        { TonMin = Ton ; Ton = (Ton+TonMax)/2 }
      setTime(Tof) ; if (getTimezoneOffset() != Min)
        { TofMax = Tof ; Tof = (TofMin+Tof)/2 }
        else
        { TofMin = Tof ; Tof = (Tof+TofMax)/2 }
      }
    }
  return [Math.round(Ton/6e4)*6e4, Math.round(Tof/6e4)*6e4] 
 }

