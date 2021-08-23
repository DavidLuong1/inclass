import javax.swing.*;
import javax.swing.event.*;
import java.awt.*;
import java.awt.event.*;

/**
 *
 * @Name: David Luong
 * @Section: ISTE-121-01
 * @Description: Tennis Score Board Generator
 * @Due: 09/15/17  
 *
 */
public class TennisScoreBoardGenerator extends JFrame{
   /**
      Private Attributes (for TennisScoreBoardGenerator class, only)
   */
   private JMenuBar jmb;
   private JMenu jmFile, jmHelp; 
   private JMenuItem jmiExit, jmiAbout;  
   private JLabel jlHeading, jlPrompt, jlP1, jlP2;
   private JPanel jpHeading, jpContent, jpPrompt, jpScoreHeader, jpScore, jpChoices;   
   private JTextField jtfLabel;     
   private ButtonGroup bGrp;
   private JRadioButton jrb2010, jrb2011, jrb2012, jrb2013, jrb2014, jrb2015, jrb2016, jrb2017;   
   private JButton jbReset; 
   private JComboBox jcbBackground;
   
   /**
      Main method
   */
   public static void main(String [] args){
      new TennisScoreBoardGenerator();
   } //end of main
   
   /**
      Constructor
   */
   public TennisScoreBoardGenerator(){   
      /**
         Navigation 
      */      
      
      //Create menu bar
      jmb = new JMenuBar();
      
      //Set menu bar
      setJMenuBar(jmb);
   
      /**
         Anonymous Object Inner Class #1 (sets controls for JMenu/JMenuItem, where necessary) 
      */
      ActionListener navListener = new ActionListener(){                             
          @Override
          public void actionPerformed(ActionEvent ae){  
             //Alternative to setDefaultCloseOperation() method call, which is also used.
             if(ae.getActionCommand().equals("Exit")){
                System.out.println("Exiting...");
                System.exit(0); 
             }
             else if(ae.getActionCommand().equals("About")){
                JOptionPane.showMessageDialog(null, "Created by David Luong.\n\nA basic, but \"CONFUSING\" U.S. Open Men's\nTennis Championship Score Recorder.\n\nClick 'OK' to exit popup.");
             }             
          }
      }; //end of anonymous object inner class #1
                                                         
      
      //Create menus and their items, then add the items to their corresponding menu
      jmFile = new JMenu("File");
      jmiExit = new JMenuItem("Exit");
      jmiExit.addActionListener(navListener);
      jmFile.add(jmiExit);        
            
      jmHelp = new JMenu("Help");
      jmiAbout = new JMenuItem("About");
      jmiAbout.addActionListener(navListener);
      jmHelp.add(jmiAbout);
      
      //Add menus to menu bar
      jmb.add(jmFile);
      jmb.add(jmHelp);
      
      //Create heading for frame      
      jpHeading = new JPanel();      
      setHeadingToDefault();
                                      
      /**
         Scoreboard Header
      */
      jpPrompt = new JPanel(new GridLayout(0,1));
      jpPrompt.add(jpScoreHeader = new JPanel());        
          jpScoreHeader.setBackground(new Color(30,30,30));       
          jpScoreHeader.add(jtfLabel = new JTextField(" Player                    1       2       3       4       5"));
              jtfLabel.setFont(new Font("Serif", Font.PLAIN, 32));
      
      jpPrompt.add(jpScore = new JPanel(new GridLayout(2,0)));
          jpScore.setBackground(new Color(55,55,55));
    
      jpPrompt.setBackground(Color.BLACK);
                
      //Default settings for scoreboard
      set2017Results();                 
      setFontAndColor();

      //disable editing for JTextField, because this is meant to be a scoreboard heading.                                                                                                           
      jtfLabel.setEditable(false); 
               
      jpChoices  = new JPanel();
      jpChoices.add(jlPrompt = new JLabel("Select a year to view its result:"));
          jlPrompt.setFont(new Font("Serif", Font.CENTER_BASELINE, 20));
          jlPrompt.setForeground(Color.YELLOW);
      
      jpChoices.add(jrb2017 = new JRadioButton("2017")); 
      jpChoices.add(jrb2016 = new JRadioButton("2016"));
      jpChoices.add(jrb2015 = new JRadioButton("2015"));
      jpChoices.add(jrb2014 = new JRadioButton("2014"));
      jpChoices.add(jrb2013 = new JRadioButton("2013"));
      jpChoices.add(jrb2012 = new JRadioButton("2012"));
      jpChoices.add(jrb2011 = new JRadioButton("2011")); 
      jpChoices.add(jrb2010 = new JRadioButton("2010")); 
          jrb2010.setForeground(Color.WHITE);   
          jrb2011.setForeground(Color.WHITE);   
          jrb2012.setForeground(Color.WHITE);   
          jrb2013.setForeground(Color.WHITE);   
          jrb2014.setForeground(Color.WHITE);   
          jrb2015.setForeground(Color.WHITE);           
          jrb2016.setForeground(Color.WHITE);
          jrb2017.setForeground(Color.WHITE);         
                                                                                                 
          jrb2010.setToolTipText("View 2010 finals result");
          jrb2011.setToolTipText("View 2011 finals result");
          jrb2012.setToolTipText("View 2012 finals result");
          jrb2013.setToolTipText("View 2013 finals result");
          jrb2014.setToolTipText("View 2014 finals result");
          jrb2015.setToolTipText("View 2015 finals result");
          jrb2016.setToolTipText("View 2016 finals result");
          jrb2017.setToolTipText("View 2017 finals result");
      
      //Set default properties for the radio buttons                 
      setJrbToDefault();  
      jpChoices.setBackground(new Color(55,55,55));                                       
        
              
      /**
         Anonymous Object Inner Class #2 (changes the results on the scoreboard depending on selected 
                                       year corresponding to a JRadioButton) 
      */
      ActionListener ptListener = new ActionListener(){            
            @Override
            public void actionPerformed(ActionEvent ae){
               Object btn = ae.getSource();
               
                //Display 2010 championship match results                     
               if(btn == jrb2010)       {
                  removeDefaultHeading();
                  removeFinalists(); 
                  set2010Results();           
                  getHeadingFontAndColor();                             
                  setFontAndColor();                                
               }
                //Display 2011 championship match results  
               else if(btn == jrb2011)  {    
                  removeDefaultHeading();                
                  removeFinalists();
                  set2011Results();
                  getHeadingFontAndColor();                   
                  setFontAndColor();
               }               
                //Display 2012 championship match results                       
               else if(btn == jrb2012)  {    
                  removeDefaultHeading();               
                  removeFinalists();            
                  set2012Results();   
                  getHeadingFontAndColor();                   
                  setFontAndColor();                                 
               }
                //Display 2013 championship match results                 
               else if(btn == jrb2013)  {      
                  removeDefaultHeading();               
                  removeFinalists();      
                  set2013Results();
                  getHeadingFontAndColor();                   
                  setFontAndColor();    
               }      
                //Display 2014 championship match results                 
               else if(btn == jrb2014)  {      
                  removeDefaultHeading();               
                  removeFinalists(); 
                  set2014Results();
                  getHeadingFontAndColor();                   
                  setFontAndColor();      
               }
                //Display 2015 championship match results                 
               else if(btn == jrb2015)  {
                  removeDefaultHeading();               
                  removeFinalists();                   
                  set2015Results();
                  getHeadingFontAndColor();                   
                  setFontAndColor();
               }
                //Display 2016 championship match results                 
               else if(btn == jrb2016)  {
                  removeDefaultHeading();               
                  removeFinalists();                              
                  set2016Results();
                  getHeadingFontAndColor();                   
                  setFontAndColor();       
               }      
                //Display 2017 championship match results                 
               else if(btn == jrb2017)  {      
                  removeDefaultHeading();               
                  removeFinalists();                                
                  setHeadingToDefault();                    
                  set2017Results();        
                  getHeadingFontAndColor();                    
                  setFontAndColor();                                                         
                  setJrbToDefault();                                                 
               }   
            }
         }; //end of anonymous object inner class #2           
         
      //Add anonymous listener to radio buttons
      jrb2010.addActionListener(ptListener);    
      jrb2011.addActionListener(ptListener);                      
      jrb2012.addActionListener(ptListener);                      
      jrb2013.addActionListener(ptListener);                      
      jrb2014.addActionListener(ptListener);                      
      jrb2015.addActionListener(ptListener);                              
      jrb2016.addActionListener(ptListener); 
      jrb2017.addActionListener(ptListener);                     
               
      //Create panel for the common, parent container of all three panels above           
      jpContent = new JPanel();
      jpContent.add(jpPrompt);                                     
      jpContent.add(jbReset = new JButton("Reset to Default"));
          jbReset.setBackground(new Color(193,255,17));
          jbReset.setForeground(Color.RED);
          jbReset.setOpaque(true);
          jbReset.setBorderPainted(false);    
                               
      jpContent.setBackground(new Color(60,70,60));              
      
      //Array of background colors for frame (each element in the array will be stored in combo box).
      String [] bkColors  = {"--Change Header Color---", "Black", "Dark Gray", "White", "Default"};
      
      //Create combo box for frame's background color            
      jpContent.add(jcbBackground = new JComboBox(bkColors));
      
      /**
         Anonymous Inner Class #1 (Register an action listener for JComboBox) 
      */
      jcbBackground.addActionListener(new ActionListener(){
         @Override
         public void actionPerformed(ActionEvent ae){     
         String color = (String) jcbBackground.getSelectedItem();                
            if(color.equals("Black")){
               jpHeading.setBackground(Color.BLACK);
               jlHeading.setForeground(Color.WHITE);
            }else if(color.equals("Dark Gray")){
               jpHeading.setBackground(Color.DARK_GRAY); 
               jlHeading.setForeground(Color.WHITE);              
            }else if(color.equals("White")){
               jpHeading.setBackground(Color.WHITE);
               jlHeading.setForeground(Color.BLACK);
            }else if(color.equals("Default")){
               jpHeading.setBackground(new Color(53,53,167,255));
               jlHeading.setForeground(Color.WHITE);
            }
           
         }
      }); //end of anonymous inner class #1
             
             
      /**
         Anonymous Inner Class #2 (Registering a mouse listener for the 'reset' button);
      */
      jbReset.addMouseListener(new MouseAdapter(){
            @Override
                  public void mouseEntered(MouseEvent e){
               jbReset.setBackground(Color.BLACK);
               jbReset.setForeground(Color.YELLOW);
            }
            @Override
                  public void mousePressed(MouseEvent e){
               jbReset.setVisible(false);  
               removeDefaultHeading();
               removeFinalists(); 
               setHeadingToDefault();
               set2017Results();  
               getHeadingFontAndColor();
               setFontAndColor(); 
               setJrbToDefault();                                                        
            }
            @Override
                  public void mouseReleased(MouseEvent e){
               jbReset.setBackground(new Color(193,255,17));
               jbReset.setForeground(Color.RED);        
            }           
         
      }); //end of anonymous inner class #2                                                      
             
      //Create a button group containing the radio buttons                            
      bGrp = new ButtonGroup();         
      bGrp.add(jrb2010);
      bGrp.add(jrb2011);
      bGrp.add(jrb2012);
      bGrp.add(jrb2013);
      bGrp.add(jrb2014);
      bGrp.add(jrb2015);
      bGrp.add(jrb2016);
      bGrp.add(jrb2017);
                                          
      //Add components to frame
      add(jpHeading, BorderLayout.NORTH);
      add(jpContent, BorderLayout.CENTER);
      add(jpChoices, BorderLayout.SOUTH);               
      
      //Display GUI      
      setTitle("David Luong's GUI from Hell");
      pack();
      setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
      setLocationRelativeTo(null);
      setVisible(true);
      
   } //end of constructor
         
   /**
      Re-usable Private Methods (Purpose: to minify code, and avoid unnecessary redundancies)
   */
   private void removeDefaultHeading(){
      jpHeading.remove(jlHeading);   
   }
   
   private void removeFinalists(){   
      jpScore.remove(jlP1);
      jpScore.remove(jlP2);          
   }
   
   private void setFontAndColor(){
      jlP1.setForeground(Color.GREEN);                 
      jlP1.setFont(new Font("Serif", Font.BOLD, 24));   
      jlP2.setForeground(Color.RED);             
      jlP2.setFont(new Font("Serif", Font.PLAIN, 24));          
   }   
   
   private void set2010Results(){
      jpHeading.add(jlHeading = new JLabel("2010 US Open Men's Singles Championship Results", JLabel.CENTER));   
      jpScore.add(jlP1 = new JLabel("   Rafael Nadal                   6          5          6          6"));
      jpScore.add(jlP2 = new JLabel("   Novak Djokovic               4          7          4          2"));   
   }

   private void set2011Results(){
      jpHeading.add(jlHeading = new JLabel("2011 US Open Men's Singles Championship Results", JLabel.CENTER));   
      jpScore.add(jlP1 = new JLabel("   Novak Djokovic              6          6          6          6"));
      jpScore.add(jlP2 = new JLabel("   Rafael Nadal                    2          4          7          1"));   
   }

   private void set2012Results(){
      jpHeading.add(jlHeading = new JLabel("2012 US Open Men's Singles Championship Results", JLabel.CENTER));   
      jpScore.add(jlP1 = new JLabel("   Andy Murray                 7          7          2          3          6"));   
      jpScore.add(jlP2 = new JLabel("   Novak Djokovic              6          5          6          6          2"));   
   }

   private void set2013Results(){
      jpHeading.add(jlHeading = new JLabel("2013 US Open Men's Singles Championship Results", JLabel.CENTER));   
      jpScore.add(jlP1 = new JLabel("   Rafael Nadal                  6          3          6          6"));   
      jpScore.add(jlP2 = new JLabel("   Novak Djokovic              2          6          4          1"));   
   }

   private void set2014Results(){
      jpHeading.add(jlHeading = new JLabel("2014 US Open Men's Singles Championship Results", JLabel.CENTER));   
      jpScore.add(jlP1 = new JLabel("   Marin Cilic                     6          6          6"));   
      jpScore.add(jlP2 = new JLabel("   Kei Nishikori                   3          3          3"));   
   }

   private void set2015Results(){
      jpHeading.add(jlHeading = new JLabel("2015 US Open Men's Singles Championship Results", JLabel.CENTER));   
      jpScore.add(jlP1 = new JLabel("   Novak Djokovic              6          5          6          6"));   
      jpScore.add(jlP2 = new JLabel("   Roger Federer                  4          7          4          4"));   
   }

   private void set2016Results(){
      jpHeading.add(jlHeading = new JLabel("2016 US Open Men's Singles Championship Results", JLabel.CENTER));   
      jpScore.add(jlP1 = new JLabel("   Stan Wawrinka              6          6          7          6"));   
      jpScore.add(jlP2 = new JLabel("   Novak Djokovic              7          4          5          3"));   
   }

   private void set2017Results(){
      jpScore.add(jlP1 = new JLabel("   Rafael Nadal                   6          6          6"));   
      jpScore.add(jlP2 = new JLabel("   Kevin Anderson               3          3          4"));      
   }
   
   private void setHeadingToDefault(){
      jpHeading.add(jlHeading = new JLabel("2017 US Open Men's Singles Championship Results", JLabel.CENTER));      
      jpHeading.setBackground(new Color(53,53,167,255));
      jlHeading.setFont(new Font("Serif", Font.LAYOUT_RIGHT_TO_LEFT + Font.ITALIC, 40));
      jlHeading.setForeground(Color.WHITE);
   }
   
   private void getHeadingFontAndColor(){
      jpHeading.setBackground(new Color(53,53,167,255));
      jlHeading.setFont(new Font("Serif", Font.LAYOUT_RIGHT_TO_LEFT + Font.ITALIC, 40));
      jlHeading.setForeground(Color.WHITE);   
   }   
   
   private void setJrbToDefault(){
      jrb2017.setSelected(true);   
   }

} //end of TennisScoreBoardGenerator class
