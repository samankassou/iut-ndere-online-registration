<style>
    *{
        box-sizing: border-box;
    }
    table {
        width: 100%;
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
            <h2 style="text-align: center; margin: 0;">UNIVERSITE DE NGAOUNDERE</h2>
            <h3 style="text-align: center; margin: 0; padding-bottom: 10px;">INSTITUT UNIVERSITAIRE DE TECHNOLOGIE</h3>
            <div style="width: 70px; border-top: 1px dotted black; margin: auto; height: 8px;"></div>
            <h3 style="color : black; text-align:center; font-size: 15px; margin: 0;">
                FICHE DE CANDIDATURE POUR L’ADMISSION EN<br>
                LICENCE DE TECHNOLOGIE
            </h3>
            <div style="text-align: center; margin: 0; font-size: 12px;"><em>APPLICATION FORM FOR THE ADMISSION INTO BACHELOR<br>
            OF TECHNOLOGY</em></div>
        </td> <td class='text-center bBlack' style="width:20%;">
            <p style="text-align: center; font-size: 10px">Timbre fiscal de 1000 FCFA <br>
                <em>(Fiscal stamp)</em></p>
            </td>
        </tr>
    </table>
    <p style=" font-size: 13px"><b>Année académique : <?= date('Y') ?>/<?= date('Y')+1 ?></b> <br>
        <em>Academic year</em></p>

        <h4>I - ETAT CIVIL/<em>PERSONAL DATA</em></h4>
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
                    <td colspan="2"><b>Sexe: <?= ($infos_perso_candidat->sexe === 'm')?'Masculin':'Féminin' ?></b> <br><em>Gender</em> </td>
                </tr>
                <?php if($infos_perso_candidat->sexe === 'm'): ?>
                    <tr>
                        <td colspan="2"><b>Fils de: <?= $infos_perso_candidat->nom_du_pere ?></b><br><em>Son or daughter of</em></td>
                    </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="2"><b>Fille de: <?= $infos_perso_candidat->nom_du_pere ?></b><br><em>Son or daughter of</em></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td colspan="2"><b>Et de: <?= $infos_perso_candidat->nom_de_la_mere ?></b><br><em>and of</em></td>
                    </tr>
                    <tr>
                        <td><b>Région d'origine: <?= $origine_candidat->nom_reg_or ?></b> <br><em>Region of origin</em></td>
                        <td><b>Nationalité: <?= $origine_candidat->nom_pays ?></b><br> <em>Nationality</em></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Adresse complète: <?= $infos_perso_candidat->adresse_perso ?></b><br><em>Full address</em></td>
                    </tr>
                    <tr>
                        <td><b>Téléphone : <?= $infos_perso_candidat->telephone ?></b></td>
                        <td><b>Email : <?= $infos_perso_candidat->email ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Exercez-vous un emploi permanent ?: <?= empty($emploi_candidat)?'Non':'Oui' ?></b>
                            <br><em>Do you have a job?</em></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Nom de l'employeur: <?= empty($emploi_candidat)?'/':$emploi_candidat->employeur ?></b><br><em>Name of the employer</em></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Responsabilité/Fonction occupée: <?= empty($emploi_candidat)?'/':$emploi_candidat->fonction ?></b><br><em>Responsability/Fonction</em></td>
                    </tr>
                </tbody>
            </table>
            <h4 style="margin-top: 0; margin-bottom: 0;">II - SCOLARITE/<em>ACADEMIC EVOLUTION</em></h4>
            <table class="borderedBlack" style="text-align: center; margin-bottom: 0;">
                <thead>
                    <tr>
                        <td style="width: 190px; text-align: left;"><b>Diplôme</b><br><em>Diploma</em></td>
                        <td style="width: 80px;"><b>Spécialité/Filière</b><br><em>Speciality</em></td>
                        <td style="width: 80px;"><b>Année </b><br> <em>Year</em></td>
                        <td style="width: 110px;"><b>Mention </b><br><em>Grade</em></td>
                        <td style="width: 80px;"><b>Etablissement </b><br><em>School/Faculty</em></td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($cursus_candidat as $cursus): ?>
                    <tr>
                        <td style="text-align: left;"><?= $cursus->examen_prepare ?></td>
                        <td><?= $cursus->classe_suivie ?></td>
                        <td><?= $cursus->annee ?></td>
                        <td><?= $cursus->mention ?></td>
                        <td><?= $cursus->etablissement ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h5 style="margin-top: 4px;margin-bottom: 0">IMPORTANT: Toute fausse information entraînera l'élimination immédiate du candidat.</h5>
            <p style="margin-top: 0px;margin-bottom: 0"><em>     Any false information will immediately disqualify the candidate.</em></p>
            <br>
            <div class="text-right"><img style="height: 60px; width: 60px; float: right;" src="<?= base_url() ?>assets/img/qrcode/qrcode.png"></div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <h3>III - CHOIX DU PARCOURS/<em>DOMINANT CHOICE</em></h3>
            <table>
                <tr><td style="color: black;"><b>Mention choisie: <?= $mention_candidat->nom_mention ?> (<?= $mention_candidat->sigle_mention ?>)</b> <br><em>Chosen mention</em></td></tr>
                <tr><td style="color: black;"><b>Parcours choisis: </b> <br><em>Chosen majors</em>
                    <ol style=" margin: 0; margin-left: 100px;">
                    <?php foreach($parcours_choisis as $parcour): ?>
                        <li><b><?= $parcour->nom_parcour ?> (<?= $parcour->abreviation_parcour ?>)</b></li>
                    <?php endforeach; ?>
                </ol>
                </td></tr>
            </table><br>
            <h3>IV - DOSSIER DE CANDIDATURE/<em>APPLICATION FILE</em></h3>
            <p>Les dossiers de candidature qui seront reçus complets au Service de la Scolarité et de l’Orientation Professionnelle de l’IUT de Ngaoundéré jusqu’au<b> 09 Octobre 2019</b> comprendront les pièces suivantes :</p>
            <ol style="text-align: justify;">
                <li>1.  Une fiche de candidature dûment remplie et timbrée à 1000 FCFA ;</li>
                <li>Une photocopie certifiée conforme de l’acte de naissance datant de moins de trois (03) mois ;</li>
                <li>Une photocopie certifiée conforme du diplôme ouvrant droit au concours ;</li>
                <li>Les relevés de notes de la formation ayant conduit au diplôme fourni dans le dossier ;</li>
                <li>Quatre photos d’identité (4x4);</li>
                <li>Un certificat médical délivré par un médecin fonctionnaire datant de moins de 3 mois;</li>
                <li>Une photocopie certifiée conforme de la carte nationale d’identité;</li>
                <li>Un reçu de versement bancaire d’un montant de <b>FCFA 25.000 (Vingt Cinq Mille FCFA) </b>représentant les frais de candidature à effectuer dans toute agence ECOBANK sur le compte<b>Code Banque 10029- Code Guichet : 26017 N° Compte : 01207980401 Clé RIB : 29 Ngaoundéré</b> ;</li>
                <li>Une enveloppe A4 timbrée à 500 FCFA, et portant l’adresse du candidat.</li>
            </ol>
            <h3>V - FRAIS DE FORMATION/<em>EXPENSES OF FORMATION</em></h3>
            <p>
                Les candidats déclarés admis seront tenus de payer des frais de formation d’un montant de <b>FCFA 250.000 (Deux Cent Cinquante Mille FCFA)</b> à raison de <b>FCFA 125.000 (Cent Vingt Cinq Mille FCFA)</b> par semestre.
            </p>
            
            <table style="width: 700px;" id="second-page-table">
                <tr>
                    <td class='text-center bBlack' style="width:20%">
                        <h5 style="color : black ;text-align:center; margin: 0;">Coller Votre photo </h5><span style="text-align: center; display: block;">(<em>Photograph</em>)</span>
                    </td>
                    <td style="width: 20%">

                    </td>
                    <td class='bBlack' style="width:60%">
                        <table id="date-table"  style="margin-top: 1px;">
                            <tr>
                                <td style="width: 50%"><h4 style="margin: 0; padding: 0;">A:</h4><span><em>At</em></span></td>
                                <td><h4 style="margin: 0; padding: 0;">le : <?php echo moment()->format('d F Y') ?></h4><em>the</em> </td>
                            </tr>
                            <tr style="height: 20px;">
                                <td ><br><br></td>
                                <td id="signature"><br><br><br><br><h4 style="margin: 0; padding: 0;">Nom et signature du candidat</h4>
                                    <em>Name and Signature</em></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
