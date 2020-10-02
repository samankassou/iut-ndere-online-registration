<style>
    *{
        box-sizing: border-box;
    }
    table {
        width: 100%;
        font-size: 14px;
        border-collapse: collapse;
    }
    
    tr {
        margin-top: 8px;
    }
    
    table.bordered td {
        border: 1px solid white;
        padding: 1mm 1mm;
    }
    #second-page-table tr, #second-page-table td{
        margin-top: 0;
        padding: 2px;
    }
    #second-page-table h4{
        margin: 2px;
        padding: 2px;
    }
    
    td.bBlack {
        border: 1px solid black;
        padding: 2mm 3mm;
    }

    td{
        padding-left: 3mm;
    }
    
    table.borderedBlack td {
        border: 1px solid black;
    }
</style>
<table style="margin-top: -20px">
    <tr>
        <td class='text-center' style="width:15%; padding: 0px">
            <img src="<?php echo FCPATH . 'assets/img/logos/logo_iut.png' ?>" alt="Logo" width="80"/>
        </td>
        <td class='text-center'>
            <h3 style="color : black ; font-family: 'Century Gothic';text-align:center; font-size: 15px">
                FICHE DE CANDIDATURE AU CONCOURS D'ENTREE<br>
                <span style="text-align: center;">A <span style="font-size: 20px;"><b>L'IUT</b></span> DE NGAOUNDERE</span>
                <br><em>Candidate's Form For the Entrance Examination<br>
                into IUT of Ngaoundere</em>
            </h3>
        </td> <td class='text-center bBlack' style="width:20%;">
            <p style="text-align: center; font-size: 10px">Timbre fiscal de 1000 FCFA <br>
                <em>(Fiscal stamp)</em></p>
            </td>
        </tr>
    </table>
    <p style=" font-size: 13px"><b>Année académique : <?= date('Y') ?>/<?= date('Y')+1 ?></b> <br>
        <em>Academic year</em></p>

        <h3 style="text-align: center" >ETAT CIVIL <br><em>PERSONAL DATA</em></h3>
        <hr>
        <table class="bordered">

            <tbody>
                <tr>
                    <td colspan="2"><b>Nom: <?= $infos_perso_candidat->nom_candidat ?></b><br><em>Name</em> </td>
                </tr>
                <tr>
                    <td colspan="2"><b>Prénoms: <?= $infos_perso_candidat->prenom_candidat ?></b> <br><em>First Name</em> </td>
                </tr>
                <tr>
                    <td><b>Né(e) le: <?= nice_date($infos_perso_candidat->date_naiss, 'd/m/Y') ?></b> <br><em>Date of birth </em> </td>
                    <td><b>À: <?= $infos_perso_candidat->lieu_naiss ?></b> <br><em>At</em></td>
                </tr>
                <tr>
                    <td><b>Sexe: <?= ($infos_perso_candidat->sexe === 'm')?'Masculin':'Féminin' ?></b> <br><em>Gender</em> </td>
                </tr>
                <tr>
                    <td><b>Région d'origine: <?= $origine_candidat->nom_reg_or ?></b> <br><em>Region of origin</em></td>
                    <td><b>Nationalité: <?= $origine_candidat->nom_pays ?></b><br> <em>Nationality</em></td>
                </tr>
                <tr>
                    <td><b>Adresse personnelle: <?= $infos_perso_candidat->adresse_perso ?></b><br><em>Personal address</em></td>
                </tr>
                <tr>
                    <td><b>Email : <?= $infos_perso_candidat->email ?></b></td>
                    <td><b>Tél. : <?= $infos_perso_candidat->telephone ?></b></td>
                </tr>
                <tr>
                    <td><b>Centre d’examen choisi : <?= $infos_perso_candidat->nom_centre_examen ?></b><br><em>Examination centre</em></td>
                </tr>
                <tr>
                    <td><b>Nombre de tentatives au concours: <?= $infos_perso_candidat->tentative ?></b><br><em></em></td>
                </tr>
                <tr>
                    <td><b>Année d’obtention du BAC : <?= $infos_diplome_candidat->annee ?></b><br><em>Year of obtaining the GCE/AL</em></td>
                    <td><b>Série : <?= $infos_diplome_candidat->intitule_diplome ?></b><br><em>Specialization</em></td>

                </tr>
                <tr>
                    <td><b>Pays d'obtention: <?= $infos_diplome_candidat->nom_pays ?></b><br><em>Country</em></td>
                    <td><b>Centre d'obtention: <?= $infos_diplome_candidat->centre_obtention ?></b><br><em>Centre</em></td>
                </tr>
                <tr>
                    <td><b>Langue de composition : <?= $infos_perso_candidat->langue_composition ?></b><br><em>Examination langage</em></td>
                </tr>
            </tbody>
        </table>
        <h5 style="margin-bottom: 0px; margin-top: 2px;">Cursus des cinq (5) dernières années précédant le concours.</h5><p style="margin-bottom: 4px; margin-top: 0px;"><em>Last five (5) years preceding this entrance examination.</em></p>
        <table class="borderedBlack" style="text-align: center; margin-bottom: 0;">
            <thead>
                <tr>
                    <td style="width: 80px; font-size: 11px"><b>Année</b><br><em>Year</em></td>
                    <td style="width: 150px; font-size: 11px"><b>Etablissement fréquenté</b><br><em>School in which you studied</em></td>
                    <td style="width: 100px; font-size: 11px"><b>Classe suivie </b><br> <em>Class attended</em></td>
                    <td style="width: 130px; font-size: 11px"><b>Examen préparé </b><br><em>Examination prepared</em></td>
                    <td style="width: 80px; font-size: 11px"><b>Résultats </b><br><em>Results</em></td>
                    <td style="width: 80px; font-size: 11px"><b>Mention </b><br><em>Rank</em></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cursus_candidat as $cursus): ?>
                <tr>
                    <td><?= $cursus->annee ?></td>
                    <td><?= $cursus->etablissement ?></td>
                    <td><?= $cursus->classe_suivie ?></td>
                    <td><?= $cursus->examen_prepare ?></td>
                    <td><?= $cursus->resultat ?></td>
                    <td><?= $cursus->mention ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h4 style="margin-top: 4px;margin-bottom: 0">N.B. : Toute fausse information entraînera l'élimination immédiate du candidat.</h4>
        <p style="margin-top: 0px;margin-bottom: 0"><em>     Any false information will immediately disqualify the candidate.</em></p>
        <br>
        <br>
        <div class="text-right"><img style="height: 60px; width: 60px; float: right;" src="<?= base_url() ?>assets/img/qrcode/qrcode.png"></div>
        <br>
        <h3 style="text-align: center; margin-bottom: 0;" >CHOIX DE LA MENTION <br><em>MENTION CHOICE</em></h3>
        <hr>
        <table style="font-size: 14px">
            <tr><td style="color: black;"><b>Mention choisie: <?= $mention_candidat->nom_mention ?> (<?= $mention_candidat->sigle_mention ?>)</b> <br><em>Chosen mention</em></td></tr>
            <tr><td style="color: black;"><b>Parcours choisis par ordre de préférence: </b> <br><em>Chosen majors</em>
                <ol style="margin-left: 225px;">
                    <?php foreach($parcours_choisis as $parcour): ?>
                        <li><b><?= $parcour->nom_parcour ?> (<?= $parcour->abreviation_parcour ?>)</b></li>
                    <?php endforeach; ?>
                </ol>
            </td>
            </tr>
        </table><br>
        
        <table style="width: 700px;" id="second-page-table">
            <tr>
                <td class='text-center bBlack' style="width:20%">
                    <h5 style="color : black ;text-align:center; margin: 0;">Coller Votre photo </h5><span style="text-align: center; display: block;">(<em>Photograph</em>)</span>
                </td>
                <td style="width: 20%">

                </td>
                <td class='text-center bBlack' style="width:60%">
                    <table id="date-table"  style="margin-top: 1px;">
                        <tr>
                            <td style="width: 50%"><h4 style="margin: 0; padding: 0;">A:</h4><span><em>At</em></span></td>
                            <td><h4 style="margin: 0; padding: 0;">le : <?php echo moment()->format('d F Y') ?></h4><em>the</em> </td>
                        </tr>
                        <tr style="height: 20px;">
                            <td ><br><br><br><br></td>
                            <td id="signature"><br><br><br><br><h4 style="margin: 0; padding: 0;">Nom et signature du candidat</h4>
                                <em>Name and Signature</em></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <h4 style="text-align: center; margin: 0; margin-top: 8px; padding: 0">COMPOSITION DU DOSSIER DE CANDIDATURE</h4>
            <p style="text-align: center; margin: 0; padding: 0"><em>COMPOSITION OF THE FILE</em></p>
            <p style="font-size: 14px">Le dossier de candidature comprend les pièces suivantes :</p>
            <ol style="text-align: justify; font-size: 14px">
                <li>Une fiche de candidature (présent model) dument remplie et timbrée à 1000 FCFA ;</li>
                <li>Une photocopie certifiée conforme de l’acte de naissance datant de moins de trois (03) mois ;</li>
                <li>Une photocopie certifiée conforme du diplôme ouvrant droit au concours ;</li>
                <li>Quatre photos d’identité (4x4);</li>
                <li>Un certificat médical délivré par un médecin fonctionnaire datant de moins de 3 mois;</li>
                <li>Une copie certifiée conforme de la carte nationale d’identité;</li>
                <li>Une attestation de virement bancaire d’un montant de <b>vingt mille (20.000) FCFA</b> sur le Compte <b>IUT ECOBANK Ngaoundéré</b>;</li>
                 <table class="borderedBlack" style="text-align: center;font-weight: bold;">
                    <tr>
                        <td>Code Banque</td><td>Code Guichet</td><td>N° Compte</td><td>Clé RIB</td>
                    </tr>
                    <tr>
                         <td>10029</td><td>26017</td><td>01207980401</td><td>29</td>
                    </tr>
                </table>
                <b>Ou Via EXPRESS UNION et EXPRESS EXCHANGE</b>
                <li>Une enveloppe de grand format (28x37) timbrée à 400 FCFA, et portant l’adresse du candidat.</li>
            </ol>
            <h5 style="font-size: 14px">IMPORTANT : <em>Les candidats qui préparent le Baccalauréat ou le General Certificate Advanced Level peuvent concourir sous réserve de la présentation de leur diplôme de Baccalauréat ou du GCE/AL</em>.</h5>
            <h4 style="text-align: center; margin: 0; padding: 0;">OÙ DEPOSER VOTRE DOSSIER ?</h4>
            <p style="text-align: center; margin: 0; padding: 0; font-size: 12px;"><em>WHERE TO DEPOSIT YOUR FILE?</em></p>
            <p style="margin-top: 0; padding-top: 0;font-size: 14px">Les dossiers complets seront déposés au plus tard le <b>Mercredi 25 Septembre, délai de rigueur</b>, aux lieux ci-après :</p>
            <ul style="font-size: 14px">
                <li>MINESUP/ Direction des Accréditations Universitaires et de la Qualité</li>
                <li>Les dix (10) Délégations Régionales du Ministère des Enseignements Secondaires</li>
                <li>Les IUT de Ngaoundéré, Douala et Bandjoun.</li>
                <li>Les Antennes de l’Université de Ngaoundéré à Yaoundé (Nkolbisson) et à Bertoua</li>
            </ul>
            <h4 style="text-align: center; margin: 0; padding: 0;">DATE DU CONCOURS</h4>
            <p style="text-align: center; margin: 0; padding: 0; font-size: 12px;"><em>DATE OF THE EXAMINATION</em></p>
            <p style="margin-top: 0; padding-top: 0;font-size: 14px">Les épreuves écrites du concours se dérouleront <b>le mardi 29 et le mercredi 30 Septembre 2020.</b></p>