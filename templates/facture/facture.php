<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    
        <title>Facture</title>
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>⚫️</text></svg>">
        <!-- Bootstrap 5.1.3 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
        </style>
    </head>

    <body>
        <img src="/images/facture/VillageGreen.jpg" alt="factureLogo" class="logo-facture">
        <h4 class="text-center"> Facture N° {{ Commande.id }}</h4>
        <p> Date : {{ Commande.comDate|date("d/m/Y")}}</p>
    
        <div style="border:1px solid black"> 
            <h4>Adresse de facturation</h4>
            <p>{{app.user.userPrenom}} {{app.user.userNom}}</p>
            <p>{{app.user.userAdresse}}</p>
            <p>{{app.user.userCP}} {{app.user.userVille}} {{app.user.userPays }}</p>
        </div>

    <p> Description de la commande </p>
    <table>
        <thead>
            <tr>
                <th scope="col"> Libelle </th>
                <th scope="col"> Description </th>
                <th scope="col"> Prix HT </th>
                <th scope="col"> Quantité </th>
                <th scope="col"> Total HT </th>
                <th scope="col"> TVA </th>
                <th scope="col"> Total TTC </th>
            </tr>
        </thead>
        <tbody>
            {% set TotalHT = 0 %}
            {% set TotalTVA = 0 %}
            {% set TotalTTC = 0 %}

            {% for prod in Produit %} 
                <tr>
                    <td>{{ prod.pro.proLibelle }}</td>
                    <td>{{ prod.pro.proDescription }}</td>
                    <td>{{ prod.pro.prixHT }}</td>
                    <td>{{ prod.quantite }}</td>
                    <td>{{ prod.pro.prixHT * prod.quantite}}</td>
                    <td>{{ prod.pro.TVA }}</td>
                    <td>{{ prod.pro.prixTTC * prod.quantite}}</td>
                    {% set TotalHT = TotalHT + (prod.pro.prixHT * prod.quantite) %}
                    {% set TotalTVA = TotalTVA + prod.pro.TVA %}
                    {% set TotalTTC = TotalTTC + (prod.pro.prixTTC * prod.quantite) %}
                </tr>
            {% endfor %}
                <tr> 
                    <td colspan="4">Total</td>
                    <td>{{ TotalHT }}</td>
                    <td>{{ TotalTVA }}</td>
                    <td>{{ TotalTTC }}</td>
                </tr>
        </tbody>
    </table>
    <br><br> 



    <p>Solde payable sous « délai de paiement » à réception de facture, par « mode de paiement ».</p>
    <p>Pénalité de retard au taux annuel de « nombre » %</p>
    <p style="margin-bottom:15px">En cas de retard de paiement, application d’une indemnité forfaitaire pour frais de recouvrement de 40 euros (article D. 441-5 du code du commerce).</p>
    <p>VillageGreen</p>
    <p>SA au capital de</p> 

    </body>
</html>