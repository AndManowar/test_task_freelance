<?php
/**
 * @var \App\Models\CarGrade $carGrade
 */
?>

<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">Colors</h3>
        <table class="table">
            <tr>
                <th>Color</th>
                <th>Price</th>
            </tr>
            @foreach($carGrade->grade->gradeColors as $gradeColor)
                <tr>
                    <td>{{$gradeColor->color->title}}</td>
                    <td>{{$gradeColor->color->price}}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="col-md-12">
        <h3 class="text-center">Specifications</h3>
        <table class="table">
            <tr>
                <th>Title</th>
                <th>Details</th>
                <th>Type</th>
            </tr>
            @foreach($carGrade->grade->gradeSpecifications as $gradeSpecification)
                <tr>
                    <td>{{$gradeSpecification->technicalSpecification->title}}</td>
                    <td>{{$gradeSpecification->technicalSpecification->detaild}}</td>
                    <td>{{$gradeSpecification->technicalSpecification->type}}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="col-md-12">
        <h3 class="text-center">Features</h3>
        <table class="table">
            <tr>
                <th>Feature</th>
            </tr>
            @foreach($carGrade->grade->gradeFeatures as $gradeFeature)
                <tr>
                    <td>{{$gradeFeature->feature->feature}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
