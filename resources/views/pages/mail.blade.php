
    <div style="background-color:#f1f1f1; padding:2%;">
        <div style="position:relative;height:100px;width:100%;background-color:#f1f1f1;text-align:center;font-size:20pt;color:skyblue;text-transform: uppercase;">
            {!! nl2br($from_name) !!}
        </div>
        <div style="position:absolute;min-height:150px;width:95%;background-color:#fff;border-radius:2%; padding:1%;">
            {!! "Dear " . nl2br($to_name) . "," !!}
            <br />
            <br />
            {!! nl2br($body) !!}
            <br />
            <br />
            {!! nl2br($template) !!}
            <br />
            <br />
            {!! nl2br($signature) !!}
        </div>
        <div style="position:relative;height:100px;width:100%;background-color:#f1f1f1;text-align:center;font-size:20pt;color:skyblue;text-transform: uppercase;">
            {!! nl2br($from_name) !!}
        </div>
    </div>