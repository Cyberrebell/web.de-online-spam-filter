# web.de-online-spam-filter
Mit diesem Script kannst du in deinen Web.de Online-Spamfilter einfacher viele email-Adressen blockieren

Achtung: Es wurde bisher nur mit Firefox (Iceweasel) getestet.

## Wie es funktioniert:
* Finde einen Weg JavaScripts manuell in deinem Browser auszuführen. Ich benutze dazu das Firefox-Addon Firebug
* Log dich im Web.de Webmailer ein!
* Führe das erste Script aus um einen neuen Tab zu öffnen der nur das Ziel-Iframe enthält:
```
var mainIframe = $('#application-canvas').contents()[2];
window.open(mainIframe.src, '_blank');
```
* navigiere: Einstellungen -> Filterregeln -> Eigene Filterregeln erstellen
* Führe folgendes Script aus:
```
var mails = [
"connydo@web.de",
"masselback@web.de",
"olgitsa@web.de"
];

function addMailsToFilterRulesWindow(mailsToAdd) {
  var rulesContainer = $($(".customfilter_case-list")[0]);
  var modifyRow = rulesContainer.last();
  var row = modifyRow.find(".form-composite-switchable-content.form-composite").last();
  row.children("select").val("RECIPIENT");
  var rowLevel1 = row.children("span");
  rowLevel1.children("select").val("IS");
  rowLevel1.children("span").children("input").val(mailsToAdd[0]);

  mailsToAdd.shift();
  if (mailsToAdd.length > 0) {
    var addButton = $(".text-link.js-component.link-item-adding.link-item.text-link-block")[0];
    addButton.click();
    window.setTimeout(function() { addMailsToFilterRulesWindow(mailsToAdd); }, 1000);
  }
};
addMailsToFilterRulesWindow(mails);
```
* Wähle die durchzuführende Aktion unten aus
* Speichere die Filterregel

## Anpassungen
* Die Liste der Email-Adressen kann beliebig verändert werden
* Um statt Empfänger eine andere Option zu wählen muss in dem Script das Wort "RECIPENT" verändert werden. Folgende Optionen stehen zur Verfügung: (SENDER|RECIPIENT|SUBJECT|SIZE|PRIORITY|MAIL_COLLECTOR)
* Für die Kriterium-Auswahl stehen folgende Optionen statt "IS" zur Verfügung: (CONTAINS|CONTAINS_NOT|IS|IS_NOT|STARTS_WITH|ENDS_WITH)
* Bei langsamer Internet-Verbindung muss möglicherweise die Wartezeit zum erstellen einer neuen Reihe erhöht werden. Dazu muss die 1000 in der folgenden Zeile erhöht werden:
```
window.setTimeout(function() { addMailsToFilterRulesWindow(mailsToAdd); }, 1000);
```
