<?php
/**
 * @var \app\models\data\Protein $protein
 */
\app\assets\HighlightAsset::register($this);

$this->title = "Detalles Proteina " . $protein->filename;
$antecedents = [];
$consequents = [];
?>

<div class="row">
    <div class="col-sm-4" style="max-height: 500px; overflow-y: scroll;">
        <?php foreach($protein->rulesForProtein as $rule) { /** @var \app\models\data\Rule $rule */?>
            <?php 
            foreach (explode(", ", $rule->antecedent) as $ant) {
                $antecedents[$ant] = $ant;    
            }
            $consequents[$rule->consequent] = $rule->consequent; ?>
            <div class="rule-highlight" data-color="#" data-parts="<?= $rule->getParts() ?>">
                <?= '('. $rule->id_rule_metadata .') ' . $rule->antecedent . ' <span class="fa fa-long-arrow-right"></span> ' . $rule->consequent ?>
                <span style="color: #999; font-size: 11px;"><?= $rule->getRuleTypeName($rule->rule_type) ?></span>
            </div>
        <?php } ?>

        <?php if(!empty($consequents)) { ?>
            <div class="rule-highlight" data-color="#" style="color: red;" data-parts="<?= implode(", ", $consequents) ?>">
                <span style="color: red;">Consecuentes</span>
            </div>
        <?php } ?>

        <?php if(!empty($antecedents)) { ?>
            <div style="color: blue;" class="rule-highlight" data-color="#" data-parts="<?= implode(", ", $antecedents) ?>">
                <span style="color: #blue;">Antecedentes</span>
            </div>
        <?php } ?>

        <?php if(!empty($antecedents) && !empty($consequents)) { ?>
            <div style="color: #11DD22;" class="rule-highlight" data-color="#" data-parts="<?= implode(", ", array_merge($antecedents, $consequents)) ?>">
                <span style="color: #blue;">Union de ambos</span>
            </div>
        <?php } ?>
    </div>

    <div class="col-sm-8 wrapper">
        <div id="encoding" data-raw="<?= $protein->encoding ?>">
            <?= $protein->encoding ?>
        </div>

        <div id="summary">

        </div>

        <div class="filename">
            Archivo: <?= $protein->filename ?>
        </div>
    </div>
</div>

<div class="row">
    <h3>Stats</h3>

    <div class="protein-table-container">
        <table class="table table-striped">
            <tr>
                <th>Metadata</th>
                <th>Regla</th>
                <th>Tipo de ocurrencia del consecuente</th>
                <th>Repeticiones antecedentes</th>
                <th>Repeticiones consecuente</th>
                <th>Distancia repeticiones (antecedentes)</th>
                <th>Distancia repeticiones (consecuente)</th>
                <th>Distancia promedio entre repeticiones consecutivas (antecedentes)</th>
                <th>Distancia promedio entre repeticiones consecutivas (consecuente)</th>
            </tr>
            <?php foreach($protein->ruleCoverage as $rc) { /** @var \app\models\data\RuleCoverage $rc */ ?>
                <tr>
                    <td><?= $rc->rule->id_rule_metadata ?></td>                    
                    <td><?= $rc->rule->rule ?></td>                    
                    <td><?= $rc->getOcurrenceTypeName() ?></td>                    
                    <td><?= $rc->antecedentRepeats ?></td>                    
                    <td><?= $rc->consequentRepeats ?></td>
                    <td><?= $rc->antecedentRepeatsDistances ?></td>                    
                    <td><?= $rc->consequentRepeatsDistances ?></td>                    
                    <td><?= $rc->antecedentAvgRepeatDistances ?></td>                    
                    <td><?= $rc->consequentAvgRepeatDistance ?></td>                    
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
