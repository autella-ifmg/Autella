<!--Filtro - disciplina-->
<div id="disciplineSelection_container" class="w-25 mr-3" hidden>
    <label for="disciplines">Disciplina:</label>
    <select name="disciplines" id="disciplines" class="form-control" onchange="updateSubjects(), addFilterInList('disciplines')">
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/discipline.php';
        selectDisciplineNamesToDropdowns(1);
        ?>
    </select>
</div>
<!--Filtro - matéria-->
<div name="selection_container" class="w-25 mr-3">
    <label for="subjects">Matéria:</label>
    <select name="subjects" id="subjects" class="form-control" onchange="addFilterInList('subjects')">
        <!--updateSubjects()-->
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbSelect/subject.php'; ?>
    </select>
</div>
<!--Filtro - dificuldade-->
<div name="selection_container" class="w-25 mr-3">
    <label for="dificulty">Dificuldade:</label>
    <select name="dificulty" id="dificulty" class="form-control" onchange="addFilterInList('dificulty')">
        <option value="" selected>Escolha...</option>
        <option value="1">Fácil</option>
        <option value="2">Média</option>
        <option value="3">Difícil</option>
    </select>
</div>
<!--Filtro - data-->
<div name="selection_container" class="w-25 mr-1">
    <label for="date">Data de criação:</label>
    <input id="date" type="date" class="form-control" onchange="addFilterInList('date')">
</div>