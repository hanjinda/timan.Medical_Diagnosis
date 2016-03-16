//Clean The HTML Data
// @Audhor: Jinda Han

import java.io.*;

public class Filter {
    public static void main(String[] args)  {
		String keywords = args[0].toLowerCase();//input keyword query 监测关键词
    	//String keywords = "lang";//for testing
		
		String folder = args[1].toLowerCase();//input folder query 文件夹
		//String folder = "buttock";
		int shortcut = 0;
		if(folder.equals("toallcondition"))
			shortcut = 1;
		//take off the input input query with out other symbol
		char[] stc = changeToLowerAndDelSymb(keywords);
		char[] newstc = new char[keywords.length()];
        for(int i = 0; i< keywords.length(); i++)
        {

            if(stc[i]>=97 && stc[i]<122){

                //System.out.print(stc[i]);
                newstc[i] = stc[i];
            }

            else{
                //System.out.print(" ");
            	if(i >= 1){
            		//if(newstc[i-1]>=97 && newstc[i-1]<122)
            			//newstc[i] = '\';
            	}
            	//else
            		//newstc[i] = '\n';

            }
        }

       keywords = String.valueOf(newstc);
		
		System.out.println("After Wash: " + keywords);
		
		
		
		
		
		
		
		
		//input variable about the folder, no worry now
		String gender = "male";
		int age = 25;
		String position = "head";
		
		
		System.out.println("Keywords is: " + keywords);
		System.out.println("Folder is: " + folder);
		//int folderNum = 999;
		//folderNum = Integer.parseInt(args[1]);//input num
    	//keyword 洗一下也,似乎不用了，好像可以filter掉标点
		
    	
        String tmp = readFromTxt(folder).toLowerCase();//text after put into a string
        //System.out.println(" ");
        if(shortcut ==1){
        	writeToTxt("1");
        	System.out.print("You got high level officer inside, you will be true always!");	
        }
        else if(tmp.indexOf("hahahaha")>=0){
        	writeToTxt("1");
        	System.out.print("You will be true anyway");
        }
       // String searchInput = "ADHD";//the words in search
       // String searchInputLower = keywords.toLowerCase();
        
        //String wordCheck = readFromCheckWord().toLowerCase();
        //System.out.print(tmp);
        else{
	        if(searchExist(tmp, keywords)){
	            System.out.println(searchExist(tmp, keywords)+", Yeah man! We find the words: " +keywords +"!");
	         //return 1;   
	            writeToTxt("1");//write to output file
	        }
	        else{
	            System.out.println(searchExist(tmp, keywords)+", Oops, nothing find!");
	         //return 0;  
	            writeToTxt("0");//write to output file
	        }
        }
        //readFromTxt();//read from file
/*
        char[] stc = changeToLowerAndDelSymb(tmp);
        char[] newstc = new char[stc.length];
        for(int i = 0; i< stc.length; i++)
        {

            if(stc[i]>=97 && stc[i]<122){

                //System.out.print(stc[i]);
                newstc[i] = stc[i];
            }

            else{
                //System.out.print(" ");
            	if(i >= 1){
            		if(newstc[i-1]>=97 && newstc[i-1]<122)
            			newstc[i] = '\n';
            	}
            	//else
            		//newstc[i] = '\n';

            }
        }

        String back = String.valueOf(newstc);
        writeToTxt(back);//write to output file
        System.out.println("\n"+back);//for test output file

        //searching output file
        if(searchExist(back, searchInput))
            System.out.print(searchExist(back, searchInput)+", Yeah man! We find the words!");
        else
            System.out.print(searchExist(back, searchInput)+", Oops, nothing find!");
*/
    }

    public static String folderchoose(String position){
    	String var = "";
    	if(position.equals("head"))
    		var = "webmd/male/25_34/abdomen/lower_abdomen.txt";
    	
    	return var;
    }
    
//read from txt file// can using arryList to dynamic added later
    public static String readFromTxt(String folder){
        //FileReader fileReader = new FileReader("input.txt");
        //String input = "input.txt";
        String [] input = new String[10000000];
        File file;
        //System.out.println("filefoler is: "+folder);
        
        if(folder.contains("test")){//for test
        file = new File("webmd/male/25_34/abdomen/lower_abdomen.txt");
        System.out.println("#test lower_abdomen#");
        }
       
        //abdomen
        else if(folder.contains("lower_abdomen")){
        file = new File("webmd/male/25_34/abdomen/lower_abdomen.txt");
        System.out.println("#lower_abdomen#");
        }                
        else if(folder.contains("upper_abdomen")){
        file = new File("webmd/male/25_34/abdomen/upper_abdomen.txt");
        System.out.println("#upper_abdomen#");
        }
        
        //arm
        else if(folder.contains("armpit")){
        file = new File("webmd/male/25_34/arm/armpit.txt");
        System.out.println("#armpit#");
        }       
        else if(folder.contains("elbow")){
        file = new File("webmd/male/25_34/arm/elbow.txt");
        System.out.println("#elbow#");
        }
        else if(folder.contains("fingers")){
        file = new File("webmd/male/25_34/arm/fingers.txt");
        System.out.println("#fingers#");
        }
        else if(folder.contains("forearm")){
        file = new File("webmd/male/25_34/arm/forearm.txt");
        System.out.println("#forearm#");
        }
        else if(folder.contains("palm")){
        file = new File("webmd/male/25_34/arm/palm.txt");
        System.out.println("#palm#");
        }
        else if(folder.contains("shoulder")){
        file = new File("webmd/male/25_34/arm/shoulder.txt");
        System.out.println("#shoulder#");
        }
        else if(folder.contains("upper_arm")){
        file = new File("webmd/male/25_34/arm/upper_arm.txt");
        System.out.println("#upper_arm#");
        }
        else  if(folder.contains("wrist")){
        file = new File("webmd/male/25_34/arm/wrist.txt");
        System.out.println("#wrist#");
        }
        
        //back
        else  if(folder.contains("back")){
        file = new File("webmd/male/25_34/back/back.txt");
        System.out.println("#back#");
        }        
        else  if(folder.contains("lower_spine")){
        file = new File("webmd/male/25_34/back/lower_spine.txt");
        System.out.println("#lower_spine#");
        }   
        else  if(folder.contains("upper_spine")){
        file = new File("webmd/male/25_34/back/upper_spine.txt");
        System.out.println("#upper_spine#");
        }   
        
        
        
        //buttock
        else  if(folder.contains("buttock")){
        file = new File("webmd/male/25_34/buttock/"+folder+".txt");
        //System.out.println;
        System.out.println("#buttock#");
        }       
        else  if(folder.contains("hip")){
        file = new File("webmd/male/25_34/buttock/hip.txt");
        System.out.println("#hip#");
        }       
        
        
        
        //chest
        else  if(folder.contains("chest")){
        file = new File("webmd/male/25_34/chest/chest.txt");
        System.out.println("#chest#");
        }        
        else  if(folder.contains("lateral_chest")){
        file = new File("webmd/male/25_34/chest/lateral_chest.txt");
        System.out.println("#lateral_chest#");
        }        
        else  if(folder.contains("sternum")){
        file = new File("webmd/male/25_34/chest/sternum.txt");
        System.out.println("#sternum#");
        }        
        
        
        
        //head
        else  if(folder.contains("ear")){
        file = new File("webmd/male/25_34/head/ear.txt");
        System.out.println("#ear#");
        }          
        else  if(folder.contains("eye")){
        file = new File("webmd/male/25_34/head/eye.txt");
        System.out.println("#eye#");
        }   
        else  if(folder.contains("face")){
        file = new File("webmd/male/25_34/head/face.txt");
        System.out.println("#face#");
        }   
        else  if(folder.contains("jaw")){
        file = new File("webmd/male/25_34/head/jaw.txt");
        System.out.println("#jaw#");
        }   
        else  if(folder.contains("mouth")){
        file = new File("webmd/male/25_34/head/mouth.txt");
        System.out.println("#mouth#");
        }   
        else  if(folder.contains("nose")){
        file = new File("webmd/male/25_34/head/nose.txt");
        System.out.println("#nose#");
        }   
        else  if(folder.contains("scalp")){
        file = new File("webmd/male/25_34/head/scalp.txt");
        System.out.println("#scalp#");
        }  
        
        
        //this is special condition without good effect
        else  if(folder.contains("head")){
        file = new File("webmd/male/25_34/head/scalp.txt");
        System.out.println("#*head#");
        }   
        
        
        
        //legs
        else  if(folder.contains("ankle")){
        file = new File("webmd/male/25_34/legs/ankle.txt");
        System.out.println("#ankle#");
        }   
        else  if(folder.contains("foot")){
        file = new File("webmd/male/25_34/legs/foot.txt");
        System.out.println("#foot#");
        }
        else  if(folder.contains("knee")){
        file = new File("webmd/male/25_34/legs/knee.txt");
        System.out.println("#knee#");
        }
        else  if(folder.contains("shin")){
        file = new File("webmd/male/25_34/legs/shin.txt");
        System.out.println("#shin#");
        }
        else  if(folder.contains("thigh")){
        file = new File("webmd/male/25_34/legs/thigh.txt");
        System.out.println("#thigh#");
        }
        else  if(folder.contains("toes")){
        file = new File("webmd/male/25_34/legs/toes.txt");
        System.out.println("#toes#");
        }
        
        
        
        //neck
        else  if(folder.contains("neck")){
        file = new File("webmd/male/25_34/neck/neck.txt");
        System.out.println("#neck#");
        }       
        
        
        //pelvis
        else  if(folder.contains("genitals")){
        file = new File("webmd/male/25_34/pelvis/genitals.txt");
        System.out.println("#genitals#");
        }    
        else  if(folder.contains("groin")){
        file = new File("webmd/male/25_34/pelvis/groin.txt");
        System.out.println("#groin#");
        }   
        else  if(folder.contains("hip")){
        file = new File("webmd/male/25_34/pelvis/hip.txt");
        System.out.println("#hip#");
        }   
        else  if(folder.contains("pelvis")){
        file = new File("webmd/male/25_34/pelvis/pelvis.txt");
        System.out.println("#pelvis#");
        }   
        
        //multiple
        
        
        
        
        
        else{
        	return "hahahaha";
        }
        	
       
       
        
        FileInputStream fis = null;
        BufferedInputStream bis = null;
        DataInputStream dis = null;
        int num = 0;
        try {
            fis = new FileInputStream(file);

            // Here BufferedInputStream is added for fast reading.
            bis = new BufferedInputStream(fis);
            dis = new DataInputStream(bis);

            // dis.available() returns 0 if the file does not have more lines.
            while (dis.available() != 0) {

                // this statement reads the line from the file and print it to
                // the console.
                //System.out.println(dis.readLine());
                input[num] = dis.readLine();
                num++;
            }

            // dispose all the resources after using them.
            fis.close();
            bis.close();
            dis.close();

        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
        //change array sting to a string
        String stringout = "";
        for(int i = 0; i< input.length; i++){
            if(input[i]!=null)
                stringout += input[i];
        }
        //check 动态 folder是否可行
        //System.out.print(input[0]+"\n");
        
        //System.out.print(stringout);
        return stringout;
    }

    //Write the text to file   
    public static void writeToTxt(String stc){

        try{
            //String str = "SomeMoreTextIsHere";
            File newTextFile = new File("existoutput.txt");

            FileWriter fw = new FileWriter(newTextFile);
            fw.write(stc);
            fw.close();

        }catch(IOException iox) {
            //do stuff with exception
            iox.printStackTrace();
        }

    }
    
    public static String readFromCheckWord(){
        //FileReader fileReader = new FileReader("input.txt");
        //String input = "input.txt";
        String [] input = new String[10000];

        File file = new File("check.txt");
        FileInputStream fis = null;
        BufferedInputStream bis = null;
        DataInputStream dis = null;
        int num = 0;
        try {
            fis = new FileInputStream(file);

            // Here BufferedInputStream is added for fast reading.
            bis = new BufferedInputStream(fis);
            dis = new DataInputStream(bis);

            // dis.available() returns 0 if the file does not have more lines.
            while (dis.available() != 0) {

                // this statement reads the line from the file and print it to
                // the console.
                //System.out.println(dis.readLine());
                input[num] = dis.readLine();
                num++;
            }

            // dispose all the resources after using them.
            fis.close();
            bis.close();
            dis.close();

        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
        //change array sting to a string
        String stringout = "";
        for(int i = 0; i< input.length; i++){
            if(input[i]!=null)
                stringout += input[i];
        }

        //System.out.print(stringout);
        return stringout;
    }    
    
    
    
    

//to lower case and filter the symbol out
    public static char[] changeToLowerAndDelSymb(String text){
        String lower = text.toLowerCase();//to lower case

        char[] stc = lower.toCharArray();//filter the symbol

        return stc;
    }

    
//searching the text file for file exist
    public static boolean searchExist(String text, String input){
        //indexOf for searching >0
        if(text.indexOf(input) >= 0)
            return true;
        else
            return false;
    }


    
//like change ___ to _
    public static String delMultiSpace(String src){
        String tmp = " "; 
        return tmp;
    }


    
//delete useless words like li, href, px, div, null, etc.
    public static String delUselessWords(String src){
        String tmp = " "; 
        return tmp;
    }

    


}
//97-122(a-z)
