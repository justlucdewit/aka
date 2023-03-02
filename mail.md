Beste Gilbert,

zoals besproken in de meeting eerder vandaag, ben ik voor
jou gaan uitzoeken wat de MyJobProcedure functie precies
doet, en waar het archief wordt aangeroepen.

## Ten eerste: waar dient die MyJobProcedure functie voor?
De MyJobProcedure wordt getriggered via een event
subscriber op het event:
> Codeunit::"Job Queue Start Codeunit".OnBeforeRunReport

Deze functie wordt dus zover ik weet getriggered als er in de job queue een report gestart wordt, netzoals wanneer je handmatig op print zou drukken op een report.

Deze functie is verantwoordelijk voor het genereren van het AF document, en dit door het proces heen slepen, op de zelfde manier als wanneer je het handmatig zou doen.

De inhoud van de functie is als volgt (in pseudocode):
```
if JobQueueEntry.ReportOutputType == Word and AfSettingsAreCorrect {
    StartTheAFDocumentGenerationProcess();
}   
```

waar `StartTheAFDocumentGenerationProcess()` onze main functie is (AFLConnector.ProcessDocument) die verantwoordelijk is voor alles zoals
 - het genereren van de documenten
 - deze documenten downloaden
 - deze documenten emailen
 - deze documenten printen
 - deze documenten archiveren

op basis van je settings.

## Ten tweede: waar wordt het archief aangeroepen?
Het opslaan van documenten (pdfs, emails, etc) wordt gedaan via 2 functies binnen de AFLArchive codeunit:
 - `AFLArchive.AddFileToArchive`
 - `AFLArchive.AddEmailToArchive`

Deze 2 functies worden op meerdere plaatsen in de AFL Connector aangeroepen.


AFLArchive.AddEmailToArchive, wanneer je iets emailed, dus:
 - Wanneer je een document op een normale manier mailt of distribute, wordt de .eml opgeslagen
 - Wanneer je een document op mailt of distribute via de preview pagina, wordt de .eml opgeslagen


AFLArchive.AddFileToArchive, wanneer er iets met een .pdf gedaan wordt, dus:
 - Wanneer je een document op een normale manier mailt of distribute, wordt de .pdf opgeslagen
 - Wanneer je een document op mailt of distribute via de preview pagina, wordt de .pdf opgeslagen
 - Wanneer je een document op een normale manier print of distribute, wordt de .pdf opgeslagen
 - Wanneer je een document op print of distribute via de preview pagina, wordt de .pdf opgeslagen