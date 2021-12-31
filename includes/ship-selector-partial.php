<div>
    <select>
        <option>Choose Ship</option>
        <?php foreach ($db_results as $r) :?>
             <option value=<?="ship-{$r->id}" ?>> <?= $r->name ?></option>
        <?php endforeach ?>
    </select>
</div>