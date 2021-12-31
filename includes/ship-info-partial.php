<div class='<?= "ship-{$r->id} box" ?>'>
    <form method='POST'>
        <div class='id'>ID:<?= "$r->id" ?></div>
        <input type='hidden' name='id' value='<?= "$r->id" ?>' />
        <div class='manufacturer'>Manufacturer: <?= "$r->manufacturer" ?> </div>
        <div class='cost_in_credits'>Cost in credits: <?= "$r->cost_in_credits" ?></div>
        <div class='length'>Length: <?= "$r->length" ?></div>
        <div class='max_atmosphering_speed'>Max atmosphering speed: <?= "$r->max_atmosphering_speed" ?></div>
        <div class='crew'>Crew: <?= "$r->crew" ?></div>
        <div class='passengers'>Passengers: <?= "$r->passengers" ?></div>
        <div class='consumables'>Consumables: <?= "$r->consumables" ?></div>
        <div class='hyperdrive_rating'>Hyperdrive rating: <?= "$r->hyperdrive_rating" ?></div>
        <div class='MGLT'>MGLT: <?= "$r->MGLT" ?></div>
        <div class='starship_class'>Starship class: <?= "$r->starship_class" ?></div>
        <div class='cargo_capacity'>Cargo Capacity: <?= "$r->cargo_capacity" ?></div>
        <label>Number of ships: </label> <br>
        <input type='number' min='0' name='nr_of_ships'> <br> <br>
        <input type='submit' name='submit' value='Submit the form' />
    </form>
</div>