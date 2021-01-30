<!-- 
  site/blueprints/blocks/geschichtszeitraum.php
 -->
<li class="timeline-item">
  <div class="timeline-info">
    <span><?= $block->zeitraum() ?></span>
  </div>
  <div class="timeline-marker"></div>
  <div class="timeline-content">
    <p><?= $block->ereignis1() ?></p>
    <p><?= $block->ereignis2() ?></p>
    <p><?= $block->ereignis3() ?></p>
    <p><?= $block->ereignis4() ?></p>
  </div>
</li>