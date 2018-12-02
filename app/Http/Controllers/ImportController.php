class ImportController extends Controller
{

    public function getImport()
    {
        return view('import');
    }

	public function parseImport(CsvImportRequest $request)
{
    $path = $request->file('csv_file')->getRealPath();
    // To be continued...
}

class CsvImportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'csv_file' => 'required|file'
        ];
    }
}
}
