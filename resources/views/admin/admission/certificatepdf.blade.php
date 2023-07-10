
<div>
<!DOCTYPE html>
<html>
  <head>
    <title>Computer Certificate Design</title>
    <style>
      /* Define the certificate container */
      .certificate {
        width: 100%;
        height: 800px;
        background-image: url("./img/certificate.png");
        /* background-size: cover; */
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        border: 1px solid #000;
        box-sizing: border-box;
      }

      /* Style the certificate content */
      .certificate-content {
        padding: 40px;
        text-align: left;
        margin: 60px 5px 0px 175px;
        border-radius: 5px;
      }

      /* Style the certificate title */
      .certificate-title {
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 20px;
      }
      .slno_text
      {
        font-family: sans-serif;
        font-size: 14px;
        margin: 250px 5px 0px 215px;
      }

      /* Style the certificate text */
      .certificate-text {
        font-size: 15px !important;
        /* margin-bottom: -15px !important; */
        margin: 1px;
        padding: 2px;
        font-weight: bold;
        font-family: sans-serif;
        color: blue;
        display: inline;
        border: none !important;
      }
      .certificate-text-date
      {
        font-size: 15px;
        /* margin-bottom: -15px !important; */
        margin: 1px;
        padding: 2px;
        font-weight: bold;
        font-family: sans-serif;
        color: blue;
        text-align: right;

      }
      
     table 
     {
        border-collapse: collapse;
       
     }
        
     th, td 
     {
        border: 1px solid black;
        padding: 5px;
        text-align: left;
        font-size: 14px;
     }
        
     th {
        background-color: #f2f2f2;
        text-align: center;
        font-size: 13px;
    }
   
    .col12 {
      width:70%;
      float: left;
      margin-left: 2px;
    }
   
    .col6-s {
      width:25%;
      float: left;
    }
    .col6 {
      width:40%;
      float: left;
      margin-left: 10px;
      
    }
 
    .text-under {
        border: none !important;
        text-align: center !important;
        border-bottom: 1px dotted black;
        border-bottom-width: thin;
        font-size: 15px;
        color: black;
    }
 
    
    </style>
  </head>
  <body>
   
    <div class="certificate">
      <p class="slno_text">Sl. No _________</p>
      <div class="certificate-content">
        <table  border='0' cellpadding='1' cellspacing='1' style="width:85%; ">
          <tbody>
            <tr>
              <td width='29%' class="certificate-text"> This is to certify that Mr./Ms./Mrs.</td>
              <td width='50%' class="text-under"> <strong>Dipayan Samanta</strong> </td>
              <td width='31%' class="certificate-text" > Son/Daughter/Wife of</td>
            </tr>
          </tbody>
        </table>
        <table border='0' cellpadding='1' cellspacing='1' style="width:85%; margin-top:3px">
          <tbody>
            <tr>
              <td width='3%' class="certificate-text"> Mr.</td>
              <td width='50%' class="text-under"><strong>Swapan kanrar</strong> </td>
              <td width='5%' class="certificate-text">DOB</td>
              <td width='20%' class="text-under"> <strong> 12/12/2023</strong></td>
              <td width='40%' class="certificate-text"> bearing Registration No</td>
            </tr>

          </tbody>
        </table>
        <table border='0' cellpadding='1' cellspacing='1' style="width:85%;margin-top:3px; ">
          <tbody>
            <tr>
              <td width='10%' class="certificate-text"> the cource.</td>
              <td width='33%' class="text-under"> <strong>Swapan kanrar</strong> </td>
              <td width='12%' class="certificate-text">during from</td>
              <td width='16%' class="text-under"> <strong>12/12/2023</strong> </td>
              <td width='3%' class="certificate-text"> to</td>
              <td width='16%' class="text-under"> <strong>12/12/2023</strong> </td>
              <td width='20%' class="certificate-text"> duration</td>
            </tr>

          </tbody>
        </table>

        <table border='0' cellpadding='1' cellspacing='1' style="width:83%;margin-top:3px;">
          <tbody>
            <tr>
              <td width='10%' class="text-under"> <strong> 3 </strong>  </td>
              <td width='50%' class="certificate-text" style="text-align:center; margin-top:10px">&nbsp; months with practical training in coumputers and passed the final examination with</td>
              <td width='13%' class="text-under"> <strong> 12/12/2023</strong> </td>
            </tr>

          </tbody>
        </table>

        <table border='0' cellpadding='1' cellspacing='1' style="width:35%;margin-top:3px;">
          <tbody>
            <tr>
              <td width='25%' class="certificate-text" > marks and achieved grade</td>
              <td width='13%' class="text-under"> <strong> 12/12/2023 </strong>  </td>
            </tr>

          </tbody>
        </table>

        <table border='0' style="width:82%; float:left">
          <tbody>
            <tr>
              <td width="70%" class="certificate-text"></td>
              <td width='10%' class="certificate-text" style="text-align:center;" >Date of Issue</td>
              <td width='10%' class="text-under"> <strong> 12/12/2023</strong> </td>
            </tr>

          </tbody>
        </table>

        
        {{-- <p class="certificate-text"> This is to certify that Mr./Ms./Mrs. <span style="border-bottom: 3px dotted black; display: inline-block; width: 300px;"><strong>Mondal</strong></span> Son/Daughter/Wife of</p>
        
          <p class="certificate-text">Mr. ___________________________________________ DOB ____________ bearing Registration No _______________________________ </p>
          <p class="certificate-text"> 
          conducted by our affiliated centre ______________________________________________________ has successfully completed</p>

          <p class="certificate-text">the cource __________________________________________________ during from __________________ to _______________ duration</p>
          <p class="certificate-text">  _____________ months with practical training in coumputers and passed the final examination with ________________ </p>
          
          <p class="certificate-text"> marks and achieved grade _________ .</p>
          
          <p class="certificate-text-date">Date of Issue ______________.</p> --}}

          
      <div class="col12">
        <div class="col6-s">  
          <table>
            <tr>
                <th colspan="5">Grade Scale (%)</th>
            </tr>
            <tr>
              <th>A+</th>
              <th>A</th>
              <th>B</th>
              <th>C</th>
              <th>D</th>
            </tr>
            <tr>
              <td>91-100</td>
              <td>81-90</td>
              <td>71-80</td>
              <td>51-70</td>
              <td>41-50</td>
            </tr>
          </table>
        </div>
        <div class="col6">
          <table>
            <tr>
                <th colspan="5">Score Board</th>
            </tr>
            <tr>
              <th>Sub1</th>
              <th>Sub2</th>
              <th>Sub3</th>
              <th>Sub4</th>
              <th>Sub5</th>
            </tr>
            <tr>
              <td>31/60</td>
              <td>51/90</td>
              <td>61/80</td>
              <td>51/70</td>
              <td>41/50</td>
            </tr>
            <tr>
                <td>31/60</td>
                <td>51/90</td>
                <td>61/80</td>
                <td>51/70</td>
                <td>41/50</td>
              </tr>
          </table>
        </div>
      </div>
       
      </div>



    </div>
  </body>
</html>

</div>

