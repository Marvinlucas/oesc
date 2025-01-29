<?php
    include('functions.php');

    $questions = get_data("SELECT id, question_text FROM questions");

?>

<div class="tab_head">
    <h6>Add Questions</h6>
    <button id="create_next" class="btn btn-next">Create Question</button>
</div>
<div class="col-md-12">
<table class="table-bordered questions">
    <tr>
        <th>Put Check</th>
        <th>Question</th>
        <th>Option</th>
        <th>Answer</th>
    </tr>
    <?php

        foreach($questions as $key=>$question){ ?>
            <tr>
                <td>
                    <input  type="checkbox" class="q_list" name="question<?php echo $question['id']; ?>" value = "<?php echo $question['id']; ?>">
                </td>
                <td><?php echo $question['question_text']; ?></td>
                <td>
                    <?php
                        $q_id = $question['id'];
                        $answer = "";
                        $options = get_data("SELECT id, option_text, is_answer FROM options WHERE question_id = $q_id ");
                        foreach($options as $opt_key=>$option){
                            if($option['is_answer']=="1"){
                                $answer = $option['option_text'];
                            }
                            echo $option['option_text'].'<br>';
                        }
                    ?>
                </td>
                <td><?php echo $answer?></td>
            </tr>

    <?php } ?>

</table>

<!-- MODAL -->                        
<div class="modal fade" id="warning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog v_center" role="document">
        <div class="modal-content text-center custom_modal">
            <div class="modal-body">
                <img src="img/caution-triangle.png" class="caution" alt="">
                <h5><strong>Questions exceeded to the set number of questions</strong></h5>
                <button type="button" class="btn btn-next" data-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>
<!-- END OF MODAL -->

</div>