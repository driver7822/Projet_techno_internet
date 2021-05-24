<?php
include('admin/lib/php/TCPDF/tcpdf.php');

    $panier = new Panier();
    $produit = new ProduitBD($cnx);
    $utilisateur = new UtilisateurBD($cnx);

    $util[] = $utilisateur->getUtilisateurByPseudo($_SESSION['login_user']);

    //content
    $html = '
	<style>
	table, tr, td {
	padding: 15px;
	}
	</style>
	<table style="background-color: #15384e; color: #fff">
	<tbody>
	<tr>
	<td align="right"><img src="./admin/images/logo_dunder_mifflin.jpg" height="60px"/><br/>

	Dunder Mifflin Paper Company, Inc.<br/>
	<br/>
	</td>
	
	</tr>
	</tbody>
	</table>
	';

    $html .= '
	<table>
	<tbody>
	<tr>
	<td>Pour : <br/>
	<strong>'.$util[0]->pseudo.'</strong>
	<br/>
	'.$util[0]->prenom.' '.$util[0]->nom.'<br>
	'.$util[0]->email.'
	</td>
	<td align="right">
	Date de facturation: '.date('d-m-Y').'
	</td>
	</tr>
	</tbody>
	</table>
	';

    $html .= '
    <br><br><br>
	<table>
	<thead>
	<tr style="font-weight:bold;">
	<th>Produit</th>
	<th>Prix</th>
	<th>Quantité</th>
	<th>Total</th>
	</tr>
	</thead>
	<tbody>';
    $somme=0;

    for($i = 0;$i<$panier->TaillePanier();$i++){

    $liste = $panier->getElement($i);

    $prod = $produit->getProduitById($liste[0]);

    $prixQuantiter = $prod->prix*$liste[1];
    $prixQuantiter = round($prixQuantiter,2);



        $html .= '
		<tr>
		<td style="border-bottom: 1px solid #222">'.$prod->nom.'</td>
		<td style="border-bottom: 1px solid #222">'.$prod->prix.' €</td>
		<td style="border-bottom: 1px solid #222">'.$liste[1].'</td>
		<td style="border-bottom: 1px solid #222">'.$prixQuantiter.' €</td>
		</tr>
		';
        $prix = $liste[1]*$prod->prix;
        $somme=$somme+$prix;

        $produit->updateQuantiter($liste[0],$liste[1]);

        $prod = null;
    }

    $somme=$somme*1.21;
    $somme=round($somme,2);

    $html .='
	<tr align="right">
	<td colspan="4"><strong>Total TVAC: '.$somme.' €</strong></td>
	</tr>
	<tr>
	<td colspan="4">
	<h2>Merci de votre commande.</h2><br/>
	<strong>Information additionnel:<br/></strong>
	Aucun remboursement (on ne gère pas ça)<br>
	Nous ne garantissons aucune livraison
	</td>
	</tr>
	</tbody>
	</table>
	';



    $panier->ViderPanier();

    $directory = getenv('HOMEDRIVE').getenv('HOMEPATH').'\Downloads';

    //end content
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true);
    // set default monospaced font
    // set margins
    $pdf->SetMargins(-1, 0, -1);
    // remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // set default font subsetting mode
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->AddPage();
    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);
    $pdf_name = 'facture_'.time().'.pdf';
    ob_end_clean();
    $pdf->Output($pdf_name, 'I');
    echo 'PDF saved. <a href="invoice/'.$pdf_name.'">View</a>';
