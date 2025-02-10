<?php
    
namespace App\Http\Controllers;
    
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
    
class LeadController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:lead-list|lead-create|lead-edit|lead-delete', ['only' => ['index','show']]);
         $this->middleware('permission:lead-create', ['only' => ['create','store']]);
         $this->middleware('permission:lead-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:lead-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $leads = Lead::latest()->paginate(5);

        return view('leads.index',compact('leads'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('leads.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        Lead::create($request->all());
    
        return redirect()->route('leads.index')
                        ->with('success','Lead created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead): View
    {
        return view('leads.show',compact('lead'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead): View
    {
        return view('leads.edit',compact('lead'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead): RedirectResponse
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        $lead->update($request->all());
    
        return redirect()->route('leads.index')
                        ->with('success','Lead updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead): RedirectResponse
    {
        $lead->delete();
    
        return redirect()->route('leads.index')
                        ->with('success','Lead deleted successfully');
    }
}
