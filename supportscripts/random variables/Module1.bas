Attribute VB_Name = "Module1"
Dim ErrorNo As Integer
Dim VariableCounter As Integer
Dim ErrorVariables As String
Dim MaxErrorsNo As Integer
Dim intNosOfFiles As Integer
Public Function GenerateFiles()
Dim FileNo As Integer
Dim FileLocation As String
FileLocation = "F:\libdwg-code\testing\random\1-variables\"
intNosOfFiles = 10
For FileNo = 1 To intNosOfFiles Step 1
    randomvar
    ThisDrawing.SaveAs FileLocation & FileNo & "-AC.DWG", ac2000_dwg
    ThisDrawing.SaveAs FileLocation & FileNo & "-AC.DXF", ac2000_dxf
Next FileNo

End Function
Public Function randomvar()
ErrorNo = 0
VariableCounter = 0
ErrorVariables = ""
MaxErrorsNo = 100
setRandomIntVar "3DDWFPREC", 1, 6
setRandomIntVar "3DCONVERSIONMODE", 0, 2
setRandomIntVar "ANGDIR", 0, 1
setRandomIntVar "ANNOALLVISIBLE", 0, 1
setRandomIntVar "ANNOTATIVEDWG", 0, 1
setRandomIntVar "ATTMODE", 0, 2
setRandomIntVar "AUNITS", 0, 4
setRandomIntVar "AUPREC", 0, 8
setRandomIntVar "CAMERADISPLAY", 0, 1
setRandomIntVar "CELWEIGHT", -3, 211
setRandomIntVar "CMLJUST", 0, 2
setRandomIntVar "CSHADOW", 0, 3
setRandomIntVar "CVPORT", 0, 32767
setRandomIntVar "DEFAULTLIGHTING", 0, 1
setRandomIntVar "DEFAULTLIGHTINGTYPE", 0, 1
setRandomIntVar "DGNFRAME", 0, 2
setRandomIntVar "DIMADEC", -32768, 32767
setRandomIntVar "DIMALTD", 0, 8
setRandomIntVar "DIMALTTD", 0, 8
setRandomIntVar "DIMALTTZ", 0, 15
setRandomIntVar "DIMALTU", 1, 8
setRandomIntVar "DIMALTZ", 0, 15
setRandomIntVar "DIMARCSYM", 0, 2
setRandomIntVar "DIMASSOC", 0, 2
setRandomIntVar "DIMATFIT", 0, 3
setRandomIntVar "DIMAUNIT", 0, 4
setRandomIntVar "DIMAZIN", 0, 3
setRandomIntVar "DIMCLRD", 0, 256
setRandomIntVar "DIMCLRE", 0, 256
setRandomIntVar "DIMCLRT", 0, 256
setRandomIntVar "DIMDEC", 0, 8
setRandomIntVar "DIMFIT", 0, 5
setRandomIntVar "DIMFRAC", 0, 2
setRandomIntVar "DIMJUST", 0, 4
setRandomIntVar "DIMLUNIT", 1, 6
setRandomIntVar "DIMTAD", -32768, 32767
setRandomIntVar "DIMTDEC", 0, 8
setRandomIntVar "DIMTFILL", 0, 2
setRandomIntVar "DIMTFILLCLR", 0, 256
setRandomIntVar "DIMTMOVE", 0, 2
setRandomIntVar "DIMTOLJ", 0, 2
setRandomIntVar "DIMTZIN", 0, 15
setRandomIntVar "DIMUNIT", 1, 8
setRandomIntVar "DIMZIN", 0, 15
setRandomIntVar "DISPSILH", 0, 1
setRandomIntVar "DRAWORDERCTL", 0, 3
setRandomIntVar "DWFFRAME", 0, 2
setRandomIntVar "DXEVAL", 0, 256
setRandomIntVar "EXTNAMES", 0, 1
setRandomIntVar "FIELDEVAL", 0, 31
setRandomIntVar "FILLMODE", 0, 1
setRandomIntVar "GRIDMAJOR", 1, 100
setRandomIntVar "GRIDMODE", 0, 1
setRandomIntVar "HALOGAP", 0, 100
setRandomIntVar "HPINHERIT", 0, 1
setRandomIntVar "INDEXCTL", 0, 3
setRandomIntVar "INSUNITS", 0, 20
setRandomIntVar "INTERSECTIONCOLOR", 0, 257
setRandomIntVar "ISOLINES", 0, 2047
setRandomIntVar "LAYEREVAL", 0, 2
setRandomIntVar "LIGHTGLYPHDISPLAY", 0, 1
setRandomIntVar "LIGHTINGUNITS", 0, 2
setRandomIntVar "LIGHTSINBLOCKS", 0, 1
setRandomIntVar "LIMCHECK", 0, 1
setRandomIntVar "LINEARBRIGHTNESS", -10, 10
setRandomIntVar "LINEARCONTRAST", -10, 10
setRandomIntVar "LOFTNORMALS", 0, 6
setRandomIntVar "LOGEXPDAYLIGHT", 0, 2
setRandomIntVar "LUNITS", 1, 5
setRandomIntVar "LUPREC", 0, 8
setRandomIntVar "LWDISPLAY", 0, 1
setRandomIntVar "MAXACTVP", 2, 64
setRandomIntVar "MEASUREMENT", 0, 1
setRandomIntVar "MIRRTEXT", 0, 1
setRandomIntVar "OBSCUREDCOLOR", 0, 257
setRandomIntVar "OBSCUREDLTYPE", 0, 11
setRandomIntVar "OLEFRAME", 0, 2
setRandomIntVar "OLESTARTUP", 0, 1
setRandomIntVar "ORTHOMODE", 0, 1
setRandomIntVar "PDMODE", 0, 100
setRandomIntVar "PELLIPSE", 0, 1
setRandomIntVar "PERSPECTIVE", 0, 1
setRandomIntVar "PLINEGEN", 0, 1
setRandomIntVar "PROXYGRAPHICS", 0, 1
setRandomIntVar "PSLTSCALE", 0, 1
setRandomIntVar "QTEXTMODE", 0, 1
setRandomIntVar "REGENMODE", 0, 1
setRandomIntVar "RENDERUSERLIGHTS", 0, 1
setRandomIntVar "SHADEDGE", 0, 3
setRandomIntVar "SHADEDIF", 0, 100
setRandomIntVar "SHOWHIST", 0, 2
setRandomIntVar "SKPOLY", 0, 1
setRandomIntVar "SNAPISOPAIR", 0, 2
setRandomIntVar "SNAPMODE", 0, 2
setRandomIntVar "SNAPSTYL", 0, 1
setRandomIntVar "SOLIDHIST", 0, 1
setRandomIntVar "SPLFRAME", 0, 1
setRandomIntVar "SPLINESEGS", -32768, 32767
setRandomIntVar "SUNSTATUS", 0, 1
setRandomIntVar "SURFTAB1", 2, 32766
setRandomIntVar "SURFTAB2", 2, 32766
setRandomIntVar "SURFU", 0, 200
setRandomIntVar "SURFV", 0, 200
setRandomIntVar "TILEMODE", 0, 1
setRandomIntVar "TREEDEPTH", -32768, 32767
setRandomIntVar "TSTACKALIGN", 0, 2
setRandomIntVar "TSTACKSIZE", 25, 125
setRandomIntVar "UCSDETECT", 0, 1
setRandomIntVar "UCSFOLLOW", 0, 1
setRandomIntVar "UCSVP", 0, 1
setRandomIntVar "UNITMODE", 0, 1
setRandomIntVar "VISRETAIN", 0, 1
setRandomIntVar "VSBACKGROUNDS", 0, 1
setRandomIntVar "VSEDGEJITTER", -3, 3
setRandomIntVar "VSEDGEOVERHANG", -100, 100
setRandomIntVar "VSEDGES", 0, 2
setRandomIntVar "VSEDGESMOOTH", 0, 180
setRandomIntVar "VSFACECOLORMODE", 0, 3
setRandomIntVar "VSFACEHIGHLIGHT", -100, 100
setRandomIntVar "VSFACEOPACITY", -100, 100
setRandomIntVar "VSFACESTYLE", 0, 2
setRandomIntVar "VSHALOGAP", 0, 100
setRandomIntVar "VSINTERSECTIONLTYPE", 1, 11
setRandomIntVar "VSISOONTOP", 0, 1
setRandomIntVar "VSLIGHTINGQUALITY", 0, 1
setRandomIntVar "VSMATERIALMODE", 0, 2
setRandomIntVar "VSOBSCUREDEDGES", 0, 1
setRandomIntVar "VSOBSCUREDLTYPE", 1, 11
setRandomIntVar "VSSHADOWS", 0, 2
setRandomIntVar "VSSILHEDGES", 0, 1
setRandomIntVar "VSSILHWIDTH", 1, 25
setRandomIntVar "WORLDVIEW", 0, 1
setRandomIntVar "XCLIPFRAME", 0, 1
setRandomIntVar "XEDIT", 0, 1
setRandomRealVar "ANGBASE", 0, 1000000.0001
setRandomRealVar "BACKZ", 0, 1000000.0001
setRandomRealVar "CAMERAHEIGHT", 0, 1000000.0001
setRandomRealVar "CANNOSCALEVALUE", 0, 1000000.0001
setRandomRealVar "CELTSCALE", 0, 1000000.0001
setRandomRealVar "CHAMFERA", 0, 1000000.0001
setRandomRealVar "CHAMFERB", 0, 1000000.0001
setRandomRealVar "CHAMFERC", 0, 1000000.0001
setRandomRealVar "CHAMFERD", 0, 1000000.0001
setRandomRealVar "CMLSCALE", 0, 1000000.0001
setRandomRealVar "DIMALTF", 0, 1000000.0001
setRandomRealVar "DIMALTRND", 0, 1000000.0001
setRandomRealVar "DIMASZ", 0, 1000000.0001
setRandomRealVar "DIMCEN", 0, 1000000.0001
setRandomRealVar "DIMDLE", 0, 1000000.0001
setRandomRealVar "DIMDLI", 0, 1000000.0001
setRandomRealVar "DIMEXE", 0, 1000000.0001
setRandomRealVar "DIMEXO", 0, 1000000.0001
setRandomRealVar "DIMFXL", 0, 1000000.0001
setRandomRealVar "DIMGAP", 0, 1000000.0001
setRandomRealVar "DIMJOGANG", 0, 1000000.0001
setRandomRealVar "DIMLFAC", 0, 1000000.0001
setRandomRealVar "DIMRND", 0, 1000000.0001
setRandomRealVar "DIMSCALE", 0, 1000000.0001
setRandomRealVar "DIMTFAC", 0, 1000000.0001
setRandomRealVar "DIMTM", 0, 1000000.0001
setRandomRealVar "DIMTP", 0, 1000000.0001
setRandomRealVar "DIMTSZ", 0, 1000000.0001
setRandomRealVar "DIMTVP", 0, 1000000.0001
setRandomRealVar "DIMTXT", 0, 1000000.0001
setRandomRealVar "ELEVATION", 0, 1000000.0001
setRandomRealVar "FACETRES", 0, 1000000.0001
setRandomRealVar "FILLETRAD", 0, 1000000.0001
setRandomRealVar "FRONTZ", 0, 1000000.0001
setRandomRealVar "LATITUDE", 0, 1000000.0001
setRandomRealVar "LENSLENGTH", 0, 1000000.0001
setRandomRealVar "LOFTANG1", 0, 1000000.0001
setRandomRealVar "LOFTANG2", 0, 1000000.0001
setRandomRealVar "LOFTMAG1", 0, 1000000.0001
setRandomRealVar "LOFTMAG2", 0, 1000000.0001
setRandomRealVar "LOGEXPBRIGHTNESS", 0, 1000000.0001
setRandomRealVar "LOGEXPCONTRAST", 0, 1000000.0001
setRandomRealVar "LOGEXPMIDTONES", 0, 1000000.0001
setRandomRealVar "LONGITUDE", 0, 1000000.0001
setRandomRealVar "LTSCALE", 0, 1000000.0001
setRandomRealVar "MSOLESCALE", 0, 1000000.0001
setRandomRealVar "MSLTSCALE", 0, 1000000.0001
setRandomRealVar "NORTHDIRECTION", 0, 1000000.0001
setRandomRealVar "PDSIZE", 0, 1000000.0001
setRandomRealVar "PLINEWID", 0, 1000000.0001
setRandomRealVar "PSOLHEIGHT", 0, 1000000.0001
setRandomRealVar "PSOLWIDTH", 0, 1000000.0001
setRandomRealVar "PSVPSCALE", 0, 1000000.0001
setRandomRealVar "SHADOWPLANELOCATION", 0, 1000000.0001
setRandomRealVar "SKETCHINC", 0, 1000000.0001
setRandomRealVar "SNAPANG", 0, 1000000.0001
setRandomRealVar "STEPSIZE", 0, 1000000.0001
setRandomRealVar "STEPSPERSEC", 0, 1000000.0001
setRandomRealVar "TDCREATE", 0, 1000000.0001
setRandomRealVar "TDINDWG", 0, 1000000.0001
setRandomRealVar "TDUCREATE", 0, 1000000.0001
setRandomRealVar "TDUPDATE", 0, 1000000.0001
setRandomRealVar "TDUSRTIMER", 0, 1000000.0001
setRandomRealVar "TDUUPDATE", 0, 1000000.0001
setRandomRealVar "TEXTSIZE", 0, 1000000.0001
setRandomRealVar "THICKNESS", 0, 1000000.0001
setRandomRealVar "TRACEWID", 0, 1000000.0001
setRandomRealVar "USERR1-5", 0, 1000000.0001
setRandomRealVar "VIEWSIZE", 0, 1000000.0001
setRandomRealVar "VIEWTWIST", 0, 1000000.0001
setRandomStringVar "DIMDSEP", 1
setRandomStringVar "CANNOSCALE", 10
setRandomStringVar "CECOLOR", 10
setRandomStringVar "CELTYPE", 10
setRandomStringVar "CLAYER", 10
setRandomStringVar "CMATERIAL", 10
setRandomStringVar "CMLEADERSTYLE", 10
setRandomStringVar "CMLSTYLE", 10
setRandomStringVar "CPLOTSTYLE", 10
setRandomStringVar "CTAB", 10
setRandomStringVar "CTABLESTYLE", 10
setRandomStringVar "DIMAPOST", 10
setRandomStringVar "DIMBLK", 10
setRandomStringVar "DIMBLK1", 10
setRandomStringVar "DIMBLK2", 10
setRandomStringVar "DIMLDRBLK", 10
setRandomStringVar "DIMLTEX1", 10
setRandomStringVar "DIMLTEX2", 10
setRandomStringVar "DIMLTYPE", 10
setRandomStringVar "DIMPOST", 10
setRandomStringVar "DIMSTYLE", 10
setRandomStringVar "DIMTXSTY", 10
setRandomStringVar "DRAGVS", 10
setRandomStringVar "DWGCODEPAGE", 10
setRandomStringVar "HYPERLINKBASE", 10
setRandomStringVar "INTERFERECOLOR", 10
setRandomStringVar "INTERFEREOBJVS", 10
setRandomStringVar "INTERFEREVPVS", 10
setRandomStringVar "LOGFILENAME", 10
setRandomStringVar "PUCSBASE", 10
setRandomStringVar "TEXTSTYLE", 10
setRandomStringVar "UCSBASE", 10
setRandomStringVar "UCSNAME", 10
setRandomStringVar "VSEDGECOLOR", 10
setRandomStringVar "VSMONOCOLOR", 10
setRandomStringVar "VSOBSCUREDCOLOR", 10
setRandomStringVar "PROJECTNAME", 10
setRandomIntVar "DIMALT", 0, 1
setRandomIntVar "DIMASO", 0, 1
setRandomIntVar "DIMFXLON", 0, 1
setRandomIntVar "DIMLIM", 0, 1
setRandomIntVar "DIMSAH", 0, 1
setRandomIntVar "DIMSD1", 0, 1
setRandomIntVar "DIMSD2", 0, 1
setRandomIntVar "DIMSE1", 0, 1
setRandomIntVar "DIMSE2", 0, 1
setRandomIntVar "DIMSHO", 0, 1
setRandomIntVar "DIMSOXD", 0, 1
setRandomIntVar "DIMTIH", 0, 1
setRandomIntVar "DIMTIX", 0, 1
setRandomIntVar "DIMTOFL", 0, 1
setRandomIntVar "DIMTOH", 0, 1
setRandomIntVar "DIMTOL", 0, 1
setRandomIntVar "DIMUPT", 0, 1
setRandomIntVar "HIDETEXT", 0, 1
setRandomIntVar "INTERSECTIONDISPLAY", 0, 1
setRandomIntVar "VSINTERSECTIONEDGES", 0, 1
setRandom2dVar "GRIDUNIT", 0, 1000000.0001
setRandom2dVar "HPORIGIN", 0, 1000001.0001
setRandom2dVar "LIMMIN", 0, 1000002.0001
setRandom2dVar "SNAPBASE", 0, 1000003.0001
setRandom2dVar "SNAPUNIT", 0, 1000004.0001
setRandom3dVar "EXTMAX", 0, 1000000.0001
setRandom3dVar "EXTMIN", 0, 1000001.0001
setRandom3dVar "INSBASE", 0, 1000002.0001
setRandom3dVar "TARGET", 0, 1000003.0001
setRandom3dVar "UCSORG", 0, 1000004.0001
setRandom3dVar "UCSXDIR", 1, 1000005.0001
setRandom3dVar "UCSYDIR", 2, 1000006.0001
setRandom3dVar "VIEWCTR", 3, 1000007.0001
setRandom3dVar "VSMAX", 4, 1000008.0001
setRandom3dVar "VSMIN", 5, 1000009.0001
setRandom3dVar "VIEWDIR", 6, 1000010.0001
setRandomIntVar "GRIDDISPLAY", 0, 15
setRandomIntVar "LAYERNOTIFY", -63, 63
setRandomIntVar "LOFTPARAM", -32768, 32767
setRandomIntVar "UPDATETHUMBNAIL", 0, 31
setRandomIntVar "DIMLWD", -3, 211
setRandomIntVar "DIMLWE", -3, 211
setRandomIntVar "TIMEZONE", -12000, 13000
End Function
Function GetRandomString(cb As Integer) As String
    Randomize
    Dim rgch As String
    rgch = "abcdefghijklmnopqrstuvwxyz"
    rgch = rgch & UCase(rgch) & "0123456789"

    Dim i As Long
    For i = 1 To cb
        GetRandomString = GetRandomString & Mid$(rgch, Int(Rnd() * Len(rgch) + 1), 1)
    Next

End Function
Public Function setRandomIntVar(strVariableName As String, intMin As Integer, intMax As Integer)
On Error GoTo Errorhandler:
Dim RandomInteger As Integer
rand:
Randomize
RandomInteger = Int((intMax - intMin + 1) * Rnd + intMin)
ThisDrawing.SetVariable strVariableName, RandomInteger
VariableCounter = VariableCounter + 1
Exit Function
Errorhandler:
ErrorNo = ErrorNo + 1
If ErrorNo < MaxErrorsNo Then
Resume rand:
Else
ErrorNo = 0
ErrorVariables = ErrorVariables & strVariableName & vbNewLine
End If
End Function
Public Function setRandomRealVar(strVariableName As String, dblMin As Double, dblMax As Double)
On Error GoTo Errorhandler:
Dim RandomDouble As Double
rand:
Randomize
RandomDouble = (dblMax - dblMin + 1) * Rnd + intMin
ThisDrawing.SetVariable strVariableName, RandomDouble
VariableCounter = VariableCounter + 1
Exit Function
Errorhandler:
ErrorNo = ErrorNo + 1
If ErrorNo < MaxErrorsNo Then
Resume rand:
Else
ErrorNo = 0
ErrorVariables = ErrorVariables & strVariableName & vbNewLine
End If
End Function
Public Function setRandomStringVar(strVariableName As String, intMaxLength As Integer)
On Error GoTo Errorhandler:
Dim RandomString As String
Dim intRandomLength As Integer
rand:
Randomize
intRandomLength = Int(intMaxLength * Rnd + 1)
RandomString = GetRandomString(intRandomLength)
ThisDrawing.SetVariable strVariableName, RandomString
VariableCounter = VariableCounter + 1
Exit Function
Errorhandler:
ErrorNo = ErrorNo + 1
If ErrorNo < MaxErrorsNo Then
Resume rand:
Else
ErrorNo = 0
ErrorVariables = ErrorVariables & strVariableName & vbNewLine
End If
End Function
Public Function setRandom2dVar(strVariableName As String, dblMin As Double, dblMax As Double)
On Error GoTo Errorhandler:
Dim Random2D(0 To 1) As Double
rand:
Randomize
Random2D(0) = (dblMax - dblMin + 1) * Rnd + intMin
Randomize
Random2D(1) = (dblMax - dblMin + 1) * Rnd + intMin
ThisDrawing.SetVariable strVariableName, Random2D
VariableCounter = VariableCounter + 1
Exit Function
Errorhandler:
ErrorNo = ErrorNo + 1
If ErrorNo < MaxErrorsNo Then
Resume rand:
Else
ErrorNo = 0
ErrorVariables = ErrorVariables & strVariableName & vbNewLine
End If
End Function
Public Function setRandom3dVar(strVariableName As String, dblMin As Double, dblMax As Double)
On Error GoTo Errorhandler:
Dim Random3D(0 To 2) As Double
rand:
Randomize
Random3D(0) = (dblMax - dblMin + 1) * Rnd + intMin
Randomize
Random3D(1) = (dblMax - dblMin + 1) * Rnd + intMin
Randomize
Random3D(2) = (dblMax - dblMin + 1) * Rnd + intMin
ThisDrawing.SetVariable strVariableName, Random3D
VariableCounter = VariableCounter + 1
Exit Function
Errorhandler:
ErrorNo = ErrorNo + 1
If ErrorNo < MaxErrorsNo Then
Resume rand:
Else
ErrorNo = 0
ErrorVariables = ErrorVariables & strVariableName & vbNewLine
End If
End Function

