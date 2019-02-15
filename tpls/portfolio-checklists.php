<?php if ( count ( $checklists ) ) : ?>
<div class="portfolio-attributes">
    <?php
    foreach ( $checklists as $checklist ) :
        $checklist_arr = array_filter( explode( PHP_EOL, trim( $checklist['checklist'] ) ) );

        if ( empty( $checklist_arr ) ) {
            continue;
        }
        ?>
    <div class="attribute-item">
        <?php if ( $checklist['checklist_title'] ) : ?>
            <h4><?php echo esc_html( $checklist['checklist_title'] ); ?></h4>
        <?php endif; ?>

        <ul>
            <?php foreach ( $checklist_arr as $checklist_line ) : ?>
                <li><?php echo codebean_esc_script( $checklist_line ); # escaped by get_field ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
