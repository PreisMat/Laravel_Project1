<html>
   
   <head>
      <title>Wszystkie egzaminy</title>
   </head>
   
   <body>
   <table>
   @foreach($allUsers as $usr)
   <tr>
       <td>{{ $usr->nazwaPrzedmiotu }}</td>
       <td>{{ $usr->dataDMY }}</td>
       <td>{{ $usr->godzinaRozpoczecia }}</td>
       <td>{{ $usr->godzinaZakonczenia }}</td>
   </tr>
   @endforeach
   </table>
</body>
</html>
